<?php
class UsuariosClasse extends Controller {

	function __construct() 
	{
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de validação
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array('form_validation', 'session', 'pagination', 'auditoria'));
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		$this->load->model('cidademodel',"CidadeModel");
		$this->load->model('admin/usuarioclassemodel',"UsuarioClasseModel");
	}
	function index() 
	{
		UsuariosClasse::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
		    'base_url' 		=> site_url('/admin/usuariosClasse/listar/'),
		    'per_page' 		=> 10,
		    'total_rows'	=> $this->UsuarioClasseModel->getTotal(),
		    'uri_segment' 	=> 4,
		    'first_link' 	=> 'Primeira',
		    'last_link' 	=> 'Última'
    	);
    	$query = $this->UsuarioClasseModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $usuarioClasse['pag'] = $this->pagination->create_links();
        $usuarioClasse['usuario'] = $query->result_array();
		$this->load->view('admin/usuarioclasselistar', $usuarioClasse);
	}
	
	function filtroEmail(){
		$usuarioClasse['usuario'] = $this->UsuarioClasseModel->filtroEmail($this->input->post('email'));
		$this->load->view('admin/usuarioclasselistar', $usuarioClasse); 
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
	       	$var['row'] = $this->UsuarioClasseModel->detalhar($id);
	       	$var['cidades'] = $this->montarCidades($var['row']['estado'], $var['row']['cidade']);
		} 
		$var['estados'] = $this->EstadoModel->getAll();
		$var['cargos'] = $this->CargoModel->getAll(); 
		
		$this->load->view('admin/usuarioclassemanter', $var);
	}
	
	function deletar($id)
	{
		
		// Grava o Log 
		$usuarioClasse['row'] = $this->UsuarioClasseModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $usuarioClasse['row']['nome'], $usuarioClasse['row']['id'], "Excluiu [MEU CLASSE - Usuário]");
		$this->auditoria->gravar();
		
		$this->UsuarioClasseModel->deletar($id);
		UsuariosClasse::listar();
	}
	
	function montarCidades($estado, $cidade=false) {
		// Loads
		$this->load->helper('request');
		$this->load->model('cidademodel',"CidadeModel");
		
		// Monta as cidades
		$var['cidades'] = $this->CidadeModel->getPorEstado($estado);
		$var['cidade'] = $cidade;
		
		// Renderizacao da view
		$retorno = $this->load->view('cidadesEstado', $var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	function manter()
	{
		// Validação.
		$this->form_validation->set_rules('email', 'Login', 'required|callback_verificaLogin');
		
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('idOcupacao', 'Ocupação', 'required');
		
		// Edição
		
		// Carregar os dados passado através do formulário
		$usuarioClasse = array(
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'estado' => $this->input->post('estado'),
			'idOcupacao' => $this->input->post('idOcupacao'),
			'curriculo' => $this->input->post('curriculo'),
			'estado' 		=> $this->input->post('estado'),
			'cidade' 		=> $this->input->post('cidade'),
			//'consultor' => $this->input->post('consultor'),
			//'autorizado' => $this->input->post('autorizado')
		);
		
			
		
		if ($this->form_validation->run() == FALSE){
			$var['estados'] = $this->EstadoModel->getAll();
			$var['cargos'] = $this->CargoModel->getAll(); 
			$var['row'] = $_POST;
			
			if ($var['row']['estado']) {
				$var['cidades'] = $this->montarCidades($var['row']['estado'], $usuarioClasse['cidade']);
			}
			
			$this->load->view('admin/usuarioclassemanter',$var);
		} else {
			$idUsuario = $this->input->post('id');
			
			$nomeUsuario = $this->input->post('nome');
			$session_login = $this->session->userdata('login');
			if($idUsuario){//Edita
				// Grava Log
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Editou [MEU CLASSE - Usuário]");
				$this->auditoria->gravar();
				$this->UsuarioClasseModel->update($this->input->post('id'), $usuarioClasse);
			} else {//Adiciona
				// Grava o Log 
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Adicionou [MEU CLASSE - Usuário]");
				$this->auditoria->gravar();
				
				$this->UsuarioClasseModel->insert($usuarioClasse);
			}
			UsuariosClasse::listar();
		}		
	}
}
?>
<?php
class Usuario extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url','date','moeda', 'login'));
		$this->load->library(array ('form_validation', 'session', 'pagination') );
		$this->load->model('pdv/usuariomodel',"UsuarioModel");
		$this->load->model('pdv/perfilmodel',"PerfilModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index() 
	{
		$var['row']['perfil'] = $this->PerfilModel->todosPerfis();
		$this->load->view('pdv/usuariomanter', $var);
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/pdv/usuario/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->UsuarioModel->getTotal(),
    		'uri_segment' => 4,			
    		'first_link' => 'Primeira',
    		'last_link' => 'Ъltima'
    	);
    	
    	$query = $this->UsuarioModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $usuario['pag'] = $this->pagination->create_links();
        $usuario['usuario'] = $query->result_array();
		
        $this->load->view('pdv/usuariolistar', $usuario);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$usuario['row'] = $this->UsuarioModel->detalhar($id);
		} 
		$usuario['row']['perfil'] = $this->PerfilModel->todosPerfis();
		//print_r($usuario['perfil']);
		$this->load->view('pdv/usuariomanter',$usuario);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [USUARIO] Deletou Usuбrio do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->UsuarioModel->deletar($id);
		Usuario::listar();
	}
	
	function manter()
	{		
		// Realiza a validaзгo dos compos do Form
		if (!$_POST['id']){
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[confirmasenha]');
		} else {
			$this->form_validation->set_rules('senha', 'Senha', 'matches[confirmasenha]');
		}
		$this->form_validation->set_rules('nome', 'Nome do usuario', 'required');
		$this->form_validation->set_rules('idPerfil', 'Perfil', 'required');
		
		// Ediзгo
		$usuarioPost['row'] = $_POST;
		$usuarioPost['row']['perfil'] = $this->PerfilModel->todosPerfis();
		// Carregar os dados passado atravйs do formulбrio
		$usuario = array(
			'nome' => $this->input->post('nome'),
			'login' => $this->input->post('login'),
			'senha' => md5($this->input->post('senha')),
			'idPerfil' => $this->input->post('idPerfil')
		);
		
		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('pdv/usuariomanter', $usuarioPost);
		} else {
			$session_login = $this->session->userdata('login');
			$nomeUsuario = $this->input->post('nome');
			$idUsuario = $this->input->post('id');
			if($idUsuario){
				// Edit e Grava o Log 
				$log = "($session_login) [USUARIO] Alterou Usuario($nomeUsuario) do id ($idUsuario)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->UsuarioModel->update($_POST['id'], $usuario);
			} else {
				// Add e Grava o Log 
				$log = "($session_login) [USUARIO] Adicionou Categoria do nome ($nomeCategoria)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->UsuarioModel->insert($usuario);
			} 
			
			Usuario::listar();
		}
	
	}
}
?>
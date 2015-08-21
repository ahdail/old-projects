<?php
class Usuario extends Controller {

	function __construct() 
	{
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de validação
		$this->load->helper(array('form', 'url','date'));
		$this->load->library(array('form_validation', 'session', 'pagination'));
		
		$this->load->model('admin/usuariomodel',"UsuarioModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");		
	}
	function index() 
	{
		Usuario::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/admin/usuario/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->UsuarioModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
    	
    	$query = $this->UsuarioModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginação
        $usuario['pag'] = $this->pagination->create_links();
		
        $usuario['usuario'] = $query->result_array();
    	
		$this->load->view('admin/usuariolistar',$usuario);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$usuario['row'] = $this->UsuarioModel->detalhar($id);
		} 
			$usuario['perfil'] = $this->UsuarioModel->exibirPerfilCadastro();
			$this->load->view('admin/usuariomanter',$usuario);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [USUÁRIO] Deletou Usuário do id ($id)";  
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->UsuarioModel->deletar($id);
		Usuario::listar();
	}
	
	function verificaLogin($login)
	{
		$login = $this->UsuarioModel->verificaLogin($login);
		if ($login > 0) {
			$this->form_validation->set_message('verificaLogin', 'Login já existe');
			return false;
		} else {
			return true;
		}
	}
	
	function manter()
	{
		// Validação.
		if (!$_POST['id']){
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
			$this->form_validation->set_rules('login', 'Login', 'required|callback_verificaLogin');
		} else {
			$this->form_validation->set_rules('senha', 'Senha', 'matches[rsenha]');
		}
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		
		// Edição
		$usuarioPost['row'] = $_POST;
		// Carregar os dados passado através do formulário
		$usuario = array(
			'nome' => $this->input->post('nome'),
			'senha' => md5($this->input->post('senha')),
			'login' => $this->input->post('login'),
			'idPerfil' => $this->input->post('idPerfil')
		);
		
		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);
		
		if ($this->form_validation->run() == FALSE){
			$usuarioPost['perfil'] = $this->UsuarioModel->exibirPerfil();
			$this->load->view('admin/usuariomanter',$usuarioPost);
		} else {
			$idUsuario = $this->input->post('id');
			$nomeUsuario = $this->input->post('nome');
			$session_login = $this->session->userdata('login');
			if($idUsuario){
				// Grava o Log 
				$log = "($session_login) [USUÁRIO] Alterou Usuário do id ($idUsuario) do nome ($nomeUsuario)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d H:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->UsuarioModel->update($_POST['id'],$usuario);
			} else {
				// Grava o Log 
				$session_login = $this->session->userdata('login');
				$log = "($session_login) [USUÁRIO] Adicionou Usuário do nome ($nomeUsuario)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d H:i:s", now()));
				$this->UsuarioModel->insert($usuario);
				$this->AuditoriaModel->insert($auditoria);
			} 
			Usuario::listar();
		}		
	}
}
?>
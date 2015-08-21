<?php
class Usuario extends Controller {

	function __construct() 
	{
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de valida��o
		$this->load->helper(array('form', 'url','date','login' ));
		$this->load->library(array('form_validation', 'session', 'pagination'));
		
		$this->load->model('admin/usuariomodel',"UsuarioModel");
		
	}
	function index() 
	{
		Usuario::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/usuario/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->UsuarioModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> '�ltima'
    	);
    	
    	$query = $this->UsuarioModel->exibir($start, $config['per_page']);
        // Inciializa a paginacao
        $this->pagination->initialize($config);
        // cria links para pagina��o
        $usuario['pag'] = $this->pagination->create_links();
        $usuario['usuario'] = $query->result_array();
		
		//print_r($usuario['usuario']);
		//die();
		
		$this->load->view('admin/usuariolistar',$usuario);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$usuario['row'] = $this->UsuarioModel->detalhar($id);
		} 
			$usuario['perfil'] = $this->UsuarioModel->exibirPerfil();
			$this->load->view('admin/usuariomanter',$usuario);
	}
	
	function deletar($id)
	{
		
		$this->UsuarioModel->deletar($id);
		Usuario::listar();
	}
	
	function verificaLogin($login)
	{
		$login = $this->UsuarioModel->verificaLogin($login);
		if ($login > 0) {
			$this->form_validation->set_message('verificaLogin', 'Login j� existe, por favor escolha outro');
			return false;
		} else {
			return true;
		}
	}
	
	function manter()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		if (!$_POST['id']){
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
			$this->form_validation->set_rules('login', 'Login', 'required|callback_verificaLogin');
		} else {
			$this->form_validation->set_rules('senha', 'Senha', 'matches[rsenha]');
		}
		//$this->form_validation->set_rules('idPerfil', 'Perfil', 'required');
		
		$usuarioPost['row'] = $_POST;
		$usuario = array(
			'nome' => $this->input->post('nome'),
			'senha' => md5($this->input->post('senha')),
			'login' => $this->input->post('login'),			
		);
		
		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);
		
		if ($this->form_validation->run() == FALSE){
			$usuarioPost['perfil'] = $this->UsuarioModel->exibirPerfil();
			$this->load->view('admin/usuariomanter',$usuarioPost);
		} else {
			$idUsuario = $this->input->post('id');
			if($idUsuario){
				$this->UsuarioModel->update($idUsuario,$usuario);
			} else {				
				$this->UsuarioModel->insert($usuario);
				
			} 
			Usuario::listar();
		}		
	}
}
?>
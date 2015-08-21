<?php
class Login extends Controller {

	function __construct() 
	{
		parent::Controller();	
		$this->load->library (array ('form_validation', 'session'));
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->model('pdv/usuariomodel',"UsuarioModel");
	}
	
	function index() 
	{
		$erro['erro'] = "N";
		$this->load->view('pdv/login',$erro);
	}
	
	function validar()
	{
		
		$usuario = array(
			'login' => $this->input->post('login'),
			'senha' => md5($this->input->post('senha'))			
		);
		
		$resultado = $this->UsuarioModel->validaLogin($usuario);
		if ($resultado){
			$row = $this->UsuarioModel->validaLogin($usuario);
			$sessionDados = array('id' => $row['id'], 'nome' => $row['nome'],'login' => $row['login']);
			$this->session->set_userdata($sessionDados);
			$this->load->view('pdv/index');
			
		} else {
			$erro['erro'] = "S";
			$this->load->view('pdv/login', $erro);
		}
	}
}
?>
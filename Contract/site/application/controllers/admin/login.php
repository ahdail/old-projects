<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();				
		$this->load->library (array ('form_validation', 'session'));		
		$this->load->helper(array('form', 'url', 'login'));		
		$this->load->model('admin/usuariomodel',"UsuarioModel");
		$this->load->model('admin/noticiamodel',"NoticiaModel");
	}
	
	function index() {		
		$erro['erro'] = "N";		
		$this->load->view('admin/login',$erro);	
	}	
		
	function validar(){				
			$usuario = array('login' => $this->input->post('login'),
				 'senha' => md5($this->input->post('senha'))					
			);					
		$resultado = $this->UsuarioModel->validaLogin($usuario);		
	
		if ($resultado){
			$row = $this->UsuarioModel->validaLogin($usuario);			
			$sessionDados = array('id_usuario' => $row['id_usuario'],'login' => $row['login']);			
			$this->session->set_userdata($sessionDados);
			
			$var['secretarias'] = $this->NoticiaModel->secretarias();
			$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();						
			redirect('admin/noticia', 'refresh');
			//$this->load->view('admin/noticia', $var);
		} else {			
			$erro['erro'] = "S";			
			$this->load->view('admin/login', $erro);		
	}	}		
}
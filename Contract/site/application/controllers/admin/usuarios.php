<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		
		//$this->load->helper(array('data'));
		//$this->load->library(array('session'));
		$this->load->library(array('form_validation','pagination'));
		$this->load->model('usuariosmodel',"UsuariosModel");
		$this->load->model('portalmodel',"PortalModel");
		
		
	}

	public function index()
	{		
		$var['usuarios'] = $this->UsuariosModel->usuarios_todos();
		$var['projetos'] = $this->UsuariosModel->projetos();
		$this->load->view('usuarios', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['row'] = $this->UsuariosModel->detalhar($id);
			$var['projetos'] = $this->UsuariosModel->projetos();
			$var['usuarios'] = $this->UsuariosModel->usuarios_todos();
		}
		$this->load->view('usuarios', $var);
	}
	
	function deletar($id) 
	{
		$this->UsuariosModel->deletar($id);
		$var['usuarios'] = $this->UsuariosModel->usuarios_todos();
		$var['projetos'] = $this->UsuariosModel->projetos();
		
		$this->load->view('usuarios', $var);
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('NOME', 'Nome do Usuario', 'required');
		
		if ($_POST['Id'] == "" || $_POST['SENHA'] != ""){
			$this->form_validation->set_rules('SENHA', 'Senha', 'required|matches[REPITASENHA]|md5');
		}
		$this->form_validation->set_rules('LOGIN', 'Login', 'required');
		$this->form_validation->set_rules('EMAIL', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('TELEFONE', 'Telefone', 'required');
		$this->form_validation->set_rules('ID_PROJETO', 'Projeto Participante', 'required');
				
		$usuarioPost['row'] = $_POST;
		$usuarioPost['projetos'] = $this->UsuariosModel->projetos();
		$usuarioPost['usuarios'] = $this->UsuariosModel->usuarios_todos();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('usuarios', $usuarioPost);
		} else {
			$usuario = array(
				'NOME' 	=> $this->input->post('NOME'),
				'LOGIN'	=> $this->input->post('LOGIN'),
				'SENHA'	=> $this->input->post('SENHA'),
				'EMAIL' 	=> $this->input->post('EMAIL'),
				'TELEFONE' 	=> $this->input->post('TELEFONE'),
				'ID_PROJETO' => $this->input->post('ID_PROJETO')
			);
			
			$idusuario = $this->input->post('Id');
			if($idusuario){				
				$this->UsuariosModel->update($idusuario, $usuario);
			} else {				
				$this->UsuariosModel->insert($usuario);
			} 
			$var['usuarios'] = $this->UsuariosModel->usuarios_todos();
			$var['projetos'] = $this->UsuariosModel->projetos();
			$this->load->view('usuarios', $var);
		}	
	}
	
}
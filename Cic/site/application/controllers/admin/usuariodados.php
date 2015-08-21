<?php
class UsuarioDados extends Controller {

	// Щ necessario executar o controlador da classe Controller.
	function __construct() 
	{
		// Executa a funcao construtora da classe Controller
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de validaчуo
		$this->load->helper(array('form', 'url','date'));
		$this->load->library(array('form_validation','validation','session'));
		
		$this->load->model('admin/usuariodadosmodel',"UsuarioDadosModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	// A aчуo index щ iniciada quando nenhuma aчуo for passada na URL
	function index() 
	{
		UsuarioDados::detalhar();
	}
	
	
	function detalhar()
	{
		$session_login = $this->session->userdata('login');
		$usuarioDados['row'] = $this->UsuarioDadosModel->detalhar($session_login);
		$this->load->view('admin/usuariodadosmanter',$usuarioDados);
	}
	
	
	function manter()
	{	
		if ($_POST['acao'] == "edit"){
			if ($_POST['senha']){
				$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
			}
			if (!$_POST['nome']){
				$this->form_validation->set_rules('nome', 'Nome', 'required');
			}
		} else {
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			//$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
		}
		
		$usuarioPost['row'] = $_POST;
		$usuario = array(
			'nome' => $this->input->post('nome'),
			'senha' => md5($this->input->post('senha'))
		);
		
		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/usuariodadosmanter',$usuarioPost);
		} else {
			$session_login = $this->session->userdata('login');
			$this->UsuarioDadosModel->update($session_login,$usuario);
			UsuarioDados::detalhar();
		}
	}
}
?>
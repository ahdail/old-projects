<?php
class UsuarioDados extends Controller {

	// � necessario executar o controlador da classe Controller.
	function __construct() 
	{
		// Executa a funcao construtora da classe Controller
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de valida��o
		$this->load->helper(array('form', 'url','date'));
		$this->load->library(array('form_validation','validation','session'));
		
		$this->load->model('admin/usuariodadosmodel',"UsuarioDadosModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	// A a��o index � iniciada quando nenhuma a��o for passada na URL
	function index() 
	{
		$this->detalhar();
	}
	
	
	function detalhar()
	{
		$session_login = $this->session->userdata('login');
		$usuarioDados['row'] = $this->UsuarioDadosModel->detalhar($session_login);
		$this->load->view('admin/usuariodadosmanter',$usuarioDados);
	}
	
	
	function manter()
	{	
		// Carregar os dados passado atrav�s do formul�rio
		if ($this->input->post('senha') == ""){
			$usuarioDados = array(
			'nome' => $this->input->post('nome'),
		);
		} else {
			$usuarioDados = array(
				'senha' => md5($this->input->post('senha')),
				'nome' => $this->input->post('nome'),
			);
		}
				// Grava o Log 
		$idUsuario = $this->input->post('id');
		$nomeUsuario = $this->input->post('nome');
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [USU�RIO] Alterou Usu�rio do id ($idUsuario) do nome ($nomeUsuario)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d H:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->UsuarioDadosModel->update($session_login,$usuarioDados);
		$this->detalhar();
	}
}
?>
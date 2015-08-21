<?php
class RedeSocial extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/redesociallistar');
	}

	function listar() 
	{
		$this->load->view('admin/redesociallistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/redesocialmanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/redesociallistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/redesocialmanter');
	}
}
?>


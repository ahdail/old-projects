<?php
class OndeEstamos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/ondeestamoslistar');
	}

	function listar() 
	{
		$this->load->view('admin/ondeestamoslistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/ondeestamosmanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/ondeestamoslistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/ondeestamosmanter');
	}
}
?>


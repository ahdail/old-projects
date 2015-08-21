<?php
class Evento extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/eventolistar');
	}

	function listar() 
	{
		$this->load->view('admin/eventolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/eventomanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/eventolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/eventomanter');
	}
}
?>


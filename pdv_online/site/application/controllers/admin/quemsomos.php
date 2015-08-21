<?php
class QuemSomos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/quemsomoslistar');
	}

	function listar() 
	{
		$this->load->view('admin/quemsomoslistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/quemsomosmanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/quemsomoslistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/quemsomosmanter');
	}
}
?>


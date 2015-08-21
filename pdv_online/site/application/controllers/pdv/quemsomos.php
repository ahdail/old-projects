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
		$this->load->view('pdv/quemsomoslistar');
	}

	function listar() 
	{
		$this->load->view('pdv/quemsomoslistar');
	}
	
	function detalhar() 
	{
		$this->load->view('pdv/quemsomoslistar');
	}
	
	function detetar() 
	{
		$this->load->view('pdv/quemsomoslistar');
	}
	
	function manter() 
	{
		$this->load->view('pdv/quemsomoslistar');
	}
}
?>


<?php
class Colecao extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/colecaolistar');
	}

	function listar() 
	{
		$this->load->view('admin/colecaolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/colecaomanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/colecaolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/colecaomanter');
	}
}
?>


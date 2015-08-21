<?php
class ColecaoFotos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/colecaofotolistar');
	}

	function listar() 
	{
		$this->load->view('admin/colecaofotolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/colecaofotomanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/colecaofotolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/colecaofotomanter');
	}
}
?>


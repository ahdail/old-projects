<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/noticialistar');
	}

	function listar() 
	{
		$this->load->view('admin/noticialistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/noticiamanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/noticialistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/noticiamanter');
	}
}
?>


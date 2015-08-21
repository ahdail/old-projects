<?php
class FaleConosco extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/faleconoscolistar');
	}

	function listar() 
	{
		$this->load->view('admin/faleconoscolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/faleconoscomanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/faleconoscolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/faleconoscomanter');
	}
}
?>


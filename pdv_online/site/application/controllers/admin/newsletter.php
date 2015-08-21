<?php
class Newsletter extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/newsletterlistar');
	}

	function listar() 
	{
		$this->load->view('admin/newsletterlistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/newslettermanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/newsletterlistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/newslettermanter');
	}
}
?>


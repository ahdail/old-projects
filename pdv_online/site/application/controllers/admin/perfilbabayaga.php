<?php
class PerfilBabayaga extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/perfilbabayagalistar');
	}

	function listar() 
	{
		$this->load->view('admin/perfilbabayagalistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/perfilbabayagamanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/perfilbabayagalistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/perfilbabayagamanter');
	}
}
?>


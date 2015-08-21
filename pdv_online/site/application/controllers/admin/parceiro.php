<?php
class Parceiro extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/parceirolistar');
	}

	function listar() 
	{
		$this->load->view('admin/parceirolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/parceiromanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/parceirolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/parceiromanter');
	}
}
?>


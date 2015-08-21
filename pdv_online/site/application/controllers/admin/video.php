<?php
class Video extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/videolistar');
	}

	function listar() 
	{
		$this->load->view('admin/videolistar');
	}
	
	function detalhar() 
	{
		$this->load->view('admin/videomanter');
	}
	
	function detetar() 
	{
		$this->load->view('admin/videolistar');
	}
	
	function manter() 
	{
		$this->load->view('admin/videomanter');
	}
}
?>


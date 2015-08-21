<?php
class Foto extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/foto');		
	}
	
	function album() 
	{
		$this->load->view('admin/foto_albummanter');
	}
	
	function imagem() 
	{
		$this->load->view('admin/foto_imagem');
	}
	
}
?>
<?php
class Enquete extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/enquete');
	}
	
	function pergunta() 
	{
		$this->load->view('admin/enquete_perguntalistar');
	}
	
	function resposta() 
	{
		$this->load->view('admin/enquete_respostalistar');
	}
}
?>
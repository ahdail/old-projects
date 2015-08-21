<?php
class Inicial extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->library(array('session'));
	}
	function index() 
	{
		/*
		$ell = "Chegou";
		print_r($ell);
		die();
		*/
		$this->load->view('admin/index');
		$this->load->view('admin/menu');
		$this->load->view('admin/admin');
	}

	
}
?>
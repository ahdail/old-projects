<?php
class Jquery extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('pdv/jquery');
	}
}
?>
<?php
class Admin extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/admin');
	}
	 
	
}
?>
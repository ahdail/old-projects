<?php
class Menu extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->library(array('session'));
	}
	function index() 
	{
		$this->load->view('admin/menu');
	}
	 
	
}
?>
<?php
class Livezilla extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		//$this->load->library(array('session'));
		//$this->load->model('dicamodel',"DicaModel");
	}

	function index() 
	{
		
		if (is_dir('livezilla/') && file_exists('livezilla/index.php'))
		{
			header("Location: index.php");
			die();
		}
		
		
	}
	
}
?>
<?php
class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->session->sess_destroy();
        //$this->load->view('admin');
		redirect('admin', 'refresh');
	}
	
}
?>
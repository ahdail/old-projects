<?php
class Logout extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->library('session');
	}
	
	function index()
	{
		$this->session->userdata($sessionDados);
        $this->load->view('admin/login');
	}
	
}
?>
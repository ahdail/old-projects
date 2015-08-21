<?php
class Logout extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->library('session');
	}
	
	function index()
	{
		$this->session->sess_destroy();
        $this->load->view('admin/login');
	}
	
}
?>
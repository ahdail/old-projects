<?php
class Login extends Controller {

	function index()
	{
		
		//echo 'Hello World!';
		//$this->load->view('blogview');
		$data['title'] = "My Real Title";
		$data['heading'] = "My Real Heading";
		//$this->load->view('login', $data);
		$this->load->view('login');
	}
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secretaria extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');			
	}

	public function index()
	{		
		$this->load->view('secretaria');
	}
	
	public function ver()
	{		
		$this->load->view('secretaria_ver');
	}
}
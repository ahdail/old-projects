<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Igrejaegruta extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/noticiamodel',"NoticiaModel");			
	}

	public function index()
	{		
		$var['secretarias'] = $this->NoticiaModel->secretarias();
		$this->load->view('igrejaegruta', $var);
	}
}
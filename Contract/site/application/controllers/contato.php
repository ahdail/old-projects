<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/noticiamodel',"NoticiaModel");		
	}

	public function ouvidoria()
	{		
		$var['secretarias'] = $this->NoticiaModel->secretarias();
		$this->load->view('ouvidoria', $var);
	}
	
	public function faleconosco()
	{		
		$var['secretarias'] = $this->NoticiaModel->secretarias();
		$this->load->view('faleconosco', $var);
	}
	
	public function telefonesuteis()
	{		
		$var['secretarias'] = $this->NoticiaModel->secretarias();
		$this->load->view('telefonesuteis', $var);
	}
	
	public function envia_email()
	{		
		//$this->load->view('envia_email');
	}
}
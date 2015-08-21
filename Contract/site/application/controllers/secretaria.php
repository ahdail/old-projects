<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secretaria extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->model('admin/secretariasmodel',"SecretariaModel");	
		//$this->load->model('admin/noticiamodel',"NoticiaModel");		
	}

	public function index()
	{		
		$this->load->view('secretaria');
	}
	
	public function ver($id)
	{		
	
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['sec'] = $this->SecretariaModel->detalhar($id);		
		$var['noticias_secretaria'] = $this->SecretariaModel->noticias_secretaria($id);
		$var['eventos_secretaria'] = $this->SecretariaModel->eventos_secretaria($id);				
		
		$this->load->view('secretaria', $var);
	}
}
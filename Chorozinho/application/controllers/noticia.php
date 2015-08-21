<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticia extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		//$this->load->helper('url');	
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->model('admin/noticiamodel',"NoticiaModel");
		
	}

	public function index()
	{		
		$var['noticias_gerais'] = $this->NoticiaModel->noticias_gerais();
		$this->load->view('noticia_lista', $var);
	}
	
	public function ver($id_noticia)
	{		
		$var['noticia'] = $this->NoticiaModel->detalhar($id_noticia);
		$this->load->view('noticia_ver', $var);
	}
}
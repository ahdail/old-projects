<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		
		$this->load->helper(array('data'));
		//$this->load->library(array('session'));
		$this->load->library(array('form_validation','pagination'));
		$this->load->model('noticiamodel',"NoticiaModel");
		$this->load->model('portalmodel',"PortalModel");
		
		
	}

	public function index()
	{		
		$var['noticias'] = $this->NoticiaModel->noticias_todas();
		$this->load->view('noticia', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['row'] = $this->NoticiaModel->detalhar($id);
			$var['noticias'] = $this->NoticiaModel->noticias_todas();
		}
		$this->load->view('noticia', $var);
	}
	
	function deletar($id) 
	{
		$this->NoticiaModel->deletar($id);
		$var['noticias'] = $this->NoticiaModel->noticias_todas();
		$this->load->view('noticia', $var);
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		//$this->form_validation->set_rules('exibir', 'Onde Exibir?', 'required');
				
		$noticiaPost['row'] = $_POST;
		$noticiaPost['noticias'] = $this->NoticiaModel->noticias_todas();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('noticia', $noticiaPost);
		} else {
			$noticia = array(
				'TITULO' 	=> $this->input->post('titulo'),
				'DESCRICAO' => $this->input->post('descricao'),
				'DATA_PUBLICACAO' => date("Y-m-d"),
			);
			
			$idnoticia = $this->input->post('id');
			if($idnoticia){				
				$this->NoticiaModel->update($idnoticia, $noticia);
			} else {				
				$this->NoticiaModel->insert($noticia);
			} 
			$var['noticias'] = $this->NoticiaModel->noticias_todas();
			$this->load->view('noticia', $var);
		}	
	}
	
}
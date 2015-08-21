<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeria extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->model('admin/galeriamodel',"GaleriaModel");		
	}

	public function index()
	{						
		$var['galeria_album'] = $this->GaleriaModel->galeria_album();
		$this->load->view('galeria', $var);
	}
	
	public function ver_album($id_album)
	{	
		$var['nome_album'] = $this->GaleriaModel->nome_album($id_album);
		$var['fotos_album'] = $this->GaleriaModel->fotos_album($id_album);
		$this->load->view('galeria_fotos', $var);
	}
	
}
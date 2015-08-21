<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		//$this->load->library(array('funcoes', 'pagination'));
		
		//$this->load->helper(array('converte_data'));
		//$this->load->library(array('session'));
		$this->load->model('portalmodel',"PortalModel");
		$this->load->model('noticiamodel',"NoticiaModel");
		
		
	}

	public function index()
	{
		$var['atividades'] = $this->PortalModel->atividades();
		$var['plano_acao'] = $this->PortalModel->planoAcao();
		$var['melistones'] = $this->PortalModel->melistones();
		$var['noticias'] = $this->NoticiaModel->noticias_todas();
		
		$this->load->view('home', $var);
	}
}
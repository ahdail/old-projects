<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ComoChegar extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper('url');			
	}

	public function index()
	{
		//$var['atividades'] = $this->PortalModel->atividades();
		//$var['plano_acao'] = $this->PortalModel->planoAcao();
		//$var['melistones'] = $this->PortalModel->melistones();
		//$var['noticias'] = $this->NoticiaModel->noticias_todas();
		
		$this->load->view('comochegar');
	}
}
<?php
class Lei extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
	}
	
	function ver($id=0) 
	{			
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();	
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();	
	
		$var['lei'] = $this->LegislacaoModel->detalhar($id);
		$this->load->view('lei', $var);
	}
	
}
?>
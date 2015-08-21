<?php
class Apoio_Servico extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session'));
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");		
		
		$this->load->model('admin/apoiomodel',"ApoioModel");
	}
	
	function ver($id=0) 
	{			
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['apoios'] = $this->ApoioModel->detalhar($id);
		$this->load->view('apoio_servico', $var);
	}
	
}
?>
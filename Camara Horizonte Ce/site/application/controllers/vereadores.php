<?php
class Vereadores extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/vereadoresmodel',"VereadoresModel");
		
	}
	
	function index ()
	{		
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();				
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['vereadores'] = $this->VereadoresModel->exibirSite();
		$this->load->view('vereadores', $var);
	}
	
	function ver($id=0) 
	{			
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['vereador'] = $this->VereadoresModel->ver($id);
		
		$this->load->view('vereadores', $var);
	}
	
	function mesadiretora() 
	{			
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['mesadiretora'] = $this->VereadoresModel->mesadiretora();
		$this->load->view('mesadiretora', $var);
	}
	
	function presidente() 
	{			
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['presidente'] = $this->VereadoresModel->presidente();
		$this->load->view('presidente', $var);
	}
	
}
?>
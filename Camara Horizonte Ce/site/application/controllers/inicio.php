<?php
class Inicio extends Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter', 'data'));
		$this->load->library(array('session'));
		$this->load->model('noticiamodel',"NoticiaModel");
		$this->load->model('admin/apoiomodel',"ApoioModel");		
		$this->load->model('admin/servicomodel',"ServicoModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/bannermodel',"BannerModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
	}
	
	function index() 
	{		
		$var['noticias'] = $this->NoticiaModel->ultimas3();
		$var['destaque'] = $this->NoticiaModel->destaque();
		$var['especial'] = $this->NoticiaModel->materiaEspecial();
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		$var['banners'] = $this->BannerModel->exibirBannerSite();
		
		$this->load->view('index', $var);
		
		//$this->render('index',$var);
	}
	
}
?>
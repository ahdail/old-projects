<?php
class NovaPagina extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
		
	}

	function index()
	{
		NovaPagina::ver();
	}
	
	function ver($id) 
	{
		$var['pagina'] = $this->NovaPaginaModel->conteudo($id);
		//print_r($var['novapagina']);
		//die();
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu'] = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('novapagina', $var);	
	}
	
}
?>
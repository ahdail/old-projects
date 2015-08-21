<?php
class Presidente extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}

	function index()
	{
		Presidente::ver();
	}
	
	function ver() 
	{
		$var['conteudo'] = $this->ConteudoModel->PalavraPresidente();
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e p�ginas din�micas 
		$var['menu'] = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		
		$this->load->view('presidente', $var);	
	}
	
}
?>
<?php
class Imprensa extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}

	function index()
	{
		Imprensa::ver();
	}
	
	function ver() 
	{
		$var['conteudo'] = $this->ConteudoModel->CicEmprensa();
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('imprensa', $var);	
	}
	
	function ler($id) 
	{
		$var['conteudo'] = $this->ConteudoModel->ler($id);
		$var['secao'] = "CIC na Imprensa";
		$var['url'] = "imprensa";
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('ler', $var);	
	}
}
?>
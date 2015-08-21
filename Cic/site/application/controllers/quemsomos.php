<?php
class QuemSomos extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/quemsomosmodel',"QuemSomosModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}

	function index()
	{
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu'] = $this->NovaPaginaModel->menu();
		// exibi os dados
		$var['quemsomos'] = $this->QuemSomosModel->exibirQuemSomosSite();
		$var['diretoria'] = $this->QuemSomosModel->exibirDiretoriaSite();
		$var['presidente'] = $this->QuemSomosModel->exibirPresidenteSite();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->load->view('quemsomos', $var);
	}
}
?>
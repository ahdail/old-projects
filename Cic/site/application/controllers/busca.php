<?php
class Busca Extends Controller {
	function __construct()
	{
		parent::Controller();
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
	}
	
	function index() {
		
		// Monta a URL de requisicao
		$busca = $this->input->post('busca');
		$parametros = "cx=014288877820036578590:jjuew9lgxqe&ie=UTF-8&q={$busca}"; 
		$var['endereco'] = "http://www.dingdong.com.br/busca/buscaGoogle.php?{$parametros}";
	
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('busca', $var);	
	}
}
?>
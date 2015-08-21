<?php
class Inicio extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper(array('form', 'data', 'url'));
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('ciclodebatemodel',"CicloDebateModel");
		$this->load->model('conteudomodel',"ConteudoModel");	
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}
	
	function index($idPrograma = 0)
	{
		//INPC/IBGE
		$var['noticia'] = $this->ConteudoModel->PagInicial();
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		$var['bannerExclusivo']  = $this->BannerModel->exibirBannerExclusivo();
		// Programas
		$var['programas']  = $this->CicloDebateModel->exibirPrograma();
		$var['programaVideos']  = $this->CicloDebateModel->exibirProgramaVideo($idPrograma);
		$var['idPrograma'] = $idPrograma;
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();

		
		$this->load->view('index',$var);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
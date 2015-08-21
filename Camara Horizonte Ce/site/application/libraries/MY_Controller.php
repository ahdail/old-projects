<?php
class MY_Controller extends Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session'));
		$this->load->model('noticiamodel',"NoticiaModel");
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/videomodel',"VideoModel");
		$this->load->model('admin/servicomodel',"ServicoModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/apoiomodel',"ApoioModel");
		//$this->load->model('admin/bannermodel',"BannerModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
	}
	
	function render_top()
	{
		// Carrega as variaveis utilizadas
		$var['noticias'] = $this->NoticiaModel->ultimas5();
		//$var['destaque'] = $this->NoticiaModel->destaque();
		//$var['especial'] = $this->NoticiaModel->materiaEspecial();
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		//$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		//$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$this->load->view('inicio_inc', $var);
	}

	function render($pagina, $var=null)
	{
		
		
		$this->render_top();
		$this->load->view($pagina, $var);
		$this->render_bot();
	}

	function render_bot()
	{
		
		//Carregar enquete
		//$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		//$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		// Renderiza a view
		$this->load->view('final_inc', $var);
	}
}
?>
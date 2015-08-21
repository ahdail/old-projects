<?php
class Noticia extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library ( array ('pagination'));
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}

	function index()
	{
		$this->ver();
	}
	
	function ver($start = 0,$id = 0) 
	{
		
		$config = array(
    		'base_url' => site_url('/noticia/ver/'),
    		'per_page' => 20,
    		'total_rows' => $this->ConteudoModel->getTotal(),
    		'uri_segment' => 3,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
                
        $query = $this->ConteudoModel->PagPrincipal($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginacao
        $var['pag'] = $this->pagination->create_links();
        $var['conteudo'] = $query->result_array();
        
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
		
		$this->load->view('noticia', $var);	
	}
	
	function ler($id) 
	{
		$var['conteudo'] = $this->ConteudoModel->ler($id);
		$var['utimas5'] = $this->ConteudoModel->Ultimas5($id);
		
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
		
		$var['secao'] = "Notícia";
		$var['url'] = "noticia";
		$this->load->view('ler', $var);	
	}
	
	
}
?>
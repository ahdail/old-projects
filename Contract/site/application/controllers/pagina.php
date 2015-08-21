<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		//$this->load->library(array('funcoes', 'pagination'));
		$this->load->library(array('session'));		
		$this->load->model('admin/bannermodel',"BannerModel");		
		$this->load->model('admin/noticiamodel',"NoticiaModel");		
		$this->load->model('admin/albummodel',"AlbumModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");
		$this->load->model('admin/institucionalmodel',"InstitucionalModel");
		
		
	}

	public function index()
	{
		//$this->home;
		
		//$this->load->view('index', $var);
	}
	
	public function home(){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['noticia_pag_inicial'] = $this->NoticiaModel->noticia_pag_inicial();		
		$var['pagina_obra'] = $this->AlbumModel->pagina_obra();		
		$var['pagina_portfolio'] = $this->AlbumModel->pagina_portfolio();
		//print_r($var['pagina_portfolio']);
	}
	
	public function institucional(){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['institucional_ver'] = $this->InstitucionalModel->institucional_ver(1);	
		//print_r($var['institucional_ver']);
	}
	
	// Ajustar
	public function atuacao($cat = false){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		if($cat){
			$var['atuacao'] = $this->AlbumModel->pagina_obra($cat);	
		}
		$var['atuacao_todas'] = $this->CategoriaModel->categoria_todas();	
		$var['menu_obra'] = $this->AlbumModel->pagina_obra();	
		$var['menu_portfolio'] = $this->AlbumModel->pagina_portfolio();	
		//print_r($var['categoria_todas']);
		
	}
	
	public function portfolio($par = false){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		if($par){
			$var['portifolio'] = $this->AlbumModel->pagina_portfolio($par);	
		}
	
		$var['categoria_todas'] = $this->AlbumModel->categoria_todas($par);	
		//print_r($var['categoria_todas']);
	
	}
	// Ajustar
	
	
	public function obras_andamento($par){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
	
	}
	
	public function noticia(){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['categoria_todas'] = $this->CategoriaModel->categoria_todas();	
		// periodos
		$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();	
		print_r($var);
	}
	
	public function noticia_ver($id){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['categoria_todas'] = $this->CategoriaModel->categoria_todas();
		// periodos
		$var['noticia'] = $this->NoticiaModel->detalhar($id);
		print_r($var);		
	}
	
	public function noticia_categoria($cat){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['categoria_todas'] = $this->CategoriaModel->categoria_todas();		
		// periodos
		$var['noticia_categoria'] = $this->NoticiaModel->noticia_categoria($cat);
		print_r($var);		
	}
	
	public function noticia_periodo($periodo){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
		$var['categoria_todas'] = $this->CategoriaModel->categoria_todas();
		// periodos		
		$var['noticia_periodo'] = $this->NoticiaModel->noticia_periodo($periodo);	
	
	}
	
	public function contato(){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
	
	}
	
	public function trabalho_conosco(){
		$var['pagina_menu'] = $this->AlbumModel->paginas();	
	
	
	}
	
	
	
	
}
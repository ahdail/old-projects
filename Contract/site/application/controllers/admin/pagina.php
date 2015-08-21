<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','session', 'pagination'));
		$this->load->model('admin/noticiamodel',"NoticiaModel");
		$this->load->model('admin/eventosmodel',"EventosModel");
		
		$this->load->model('admin/videosmodel',"VideosModel");
		$this->load->model('admin/albummodel',"AlbumModel");
		$this->load->model('admin/fotosmodel',"FotosModel");
		$this->load->model('admin/bannermodel',"BannerModel");
		
		$this->load->model('admin/categoriamodel',"CategoriaModel");
		$this->load->model('admin/institucionalmodel',"InstitucionalModel");
		
	}

	public function index()
	{
		
		$this->fotos_album();
	}
	
	public function noticia()
	{
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();
		$this->load->view('admin/noticia', $var);
	}
	
	public function album()
	{
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['paginas'] = $this->AlbumModel->paginas();
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$this->load->view('admin/album', $var);
	}
	
	public function banner()
	{
		$var['banner_todos'] = $this->BannerModel->banner_todos();
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$this->load->view('admin/banner', $var);
	}
	
	public function galeria()
	{
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['fotos_todas'] = $this->FotosModel->fotos_todas();
		
		$var['display'] = "none";
		
		$this->load->view('admin/fotos_album', $var);
	}
	
	public function categoria()
	{
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$this->load->view('admin/categoria', $var);
	}
	
	public function institucional($id_institucional)
	{
		$var['institucional'] = $this->InstitucionalModel->detalhar($id_institucional);
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$this->load->view('admin/institucional', $var);
	}
	
	
	
}
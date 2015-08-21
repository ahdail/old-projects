<?php
class Inicio extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login','data', 'reduzircaracter'));
		$this->load->library(array('session'));
		$this->load->model('noticiamodel',"NoticiaModel");
		$this->load->model('admin/perfilbabayagamodel',"PerfilBabayagaModel");
		$this->load->model('admin/videomodel',"VideoModel");
		$this->load->model('admin/eventomodel',"EventoModel");
		$this->load->model('admin/bannermodel',"BannerModel");
	}
	function index() 
	{
		$var['banners'] = $this->BannerModel->exibirBannerSite();
		$var['noticias'] = $this->NoticiaModel->ultimas5();
		$var['babayaga'] = $this->PerfilBabayagaModel->ultimosPerfis();		
		$var['video'] = $this->VideoModel->ultimoVideo();
		$var['evento'] = $this->EventoModel->ultimosEventos();
		$this->load->view('index', $var);
	}
	
}
?>
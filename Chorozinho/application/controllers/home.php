<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		//$this->load->helper('url');
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		//$this->load->library(array('funcoes', 'pagination'));
		
		//$this->load->helper(array('converte_data'));
		$this->load->library(array('session'));
		$this->load->model('admin/videosmodel',"VideosModel");
		$this->load->model('admin/bannermodel',"BannerModel");
		$this->load->model('admin/agendamodel',"AgendaModel");
		$this->load->model('admin/noticiamodel',"NoticiaModel");
		
		
	}

	public function index()
	{
		$var['video_destaque'] = $this->VideosModel->video_destaque();
		//$var['videos_gerais'] = $this->VideosModel->videos_gerais();
		$var['banner_home'] = $this->BannerModel->banner_home();
		$var['agenda_geral'] = $this->AgendaModel->agenda_geral();
		$var['noticia_destaque'] = $this->NoticiaModel->noticia_destaque();
		$var['noticias'] = $this->NoticiaModel->noticias_todas();
		
		//print_r($var['videos_gerais']);
		//die();
		
		$this->load->view('index', $var);
	}
}
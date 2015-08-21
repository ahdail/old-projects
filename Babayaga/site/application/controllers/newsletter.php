<?php
class Newsletter extends Controller {

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
		// indica q o form da newsletter foi submetido
		$formSite = $this->input->post('formSite');
		
		$var['banners'] = $this->BannerModel->exibirBannerSite();
		$var['noticias'] = $this->NoticiaModel->ultimas5();
		$var['babayaga'] = $this->PerfilBabayagaModel->ultimosPerfis();		
		$var['video'] = $this->VideoModel->ultimoVideo();
		$var['evento'] = $this->EventoModel->ultimosEventos();
		//$var['enviado'] = true;
		
		if ($formSite){
		/// cadastro o email do usuario
			$this->load->model('admin/newslettermodel',"NewsletterModel");
			$newsletter = array(
					'nome'  => $this->input->post('campoNome'),
					'email' => $this->input->post('campoEmail')
			);
			
			$this->NewsletterModel->insert($newsletter);
			$var['enviado'] = true;			
		} 
		
		
		$this->load->view('home', $var);
	}
}
?>
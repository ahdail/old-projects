<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'data'));
		$this->load->library(array('session'));
		$this->load->model('noticiamodel',"NoticiaModel");
	}
	function index() 
	{
		$var['noticias'] = $this->NoticiaModel->ultimas5();
		$var['ultima'] = $this->NoticiaModel->ultimaNoticia();
		$this->load->view('noticia', $var);
	}
	
	function ver($id=0) 
	{
		$var['noticias'] = $this->NoticiaModel->ultimas5();		
		$var['atual'] = $this->NoticiaModel->detalhar($id);
		$this->load->view('noticia', $var);
	}
}
?>
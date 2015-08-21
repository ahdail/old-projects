<?php
class Video extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
		$this->load->model('admin/videomodel',"VideoModel");
	}
	function index() 
	{	
		$var['videos'] = $this->VideoModel->todosVideos();
		$var['videoUltimo'] = $this->VideoModel->ultimoVideo();
		
		$this->load->view('galeriavideos', $var);
	}
	
	function ver($id) 
	{
	
		$var['videos'] = $this->VideoModel->todosVideos();

		if ($id) {
	       	$var['video'] = $this->VideoModel->detalhar($id);
		} 

		$this->load->view('galeriavideos', $var);
	}
}
?>
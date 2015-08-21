<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->model('admin/videosmodel',"VideosModel");		
	}

	public function index()
	{		
		$var['video_ver'] = NULL;
		$var['video_destaque'] = $this->VideosModel->video_destaque();
		$var['videos_gerais'] = $this->VideosModel->videos_gerais();
		$this->load->view('videos', $var);
	}
	
	public function ver($id_video)
	{		
		$var['video_ver'] = $this->VideosModel->video_ver($id_video);
		$var['videos_gerais'] = $this->VideosModel->videos_gerais();
		$this->load->view('videos', $var);
	}
}
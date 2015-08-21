<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/videosmodel',"VideosModel");
		$this->load->model('admin/secretariasmodel',"SecretariaModel");

	}

	public function index()
	{		
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['videos_gerais'] = $this->VideosModel->videos_gerais();
		$this->load->view('admin/videos', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['video'] = $this->VideosModel->detalhar($id);
			$var['videos_gerais'] = $this->VideosModel->videos_gerais();
			$var['secretarias'] = $this->SecretariaModel->secretarias();
		}
		$this->load->view('admin/videos', $var);
	}
	
	function deletar($id) 
	{
		$this->VideosModel->deletar($id);
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['videos_gerais'] = $this->VideosModel->videos_gerais();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/videos', $var);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if ($this->input->post('destaque')) {
			$this->form_validation->set_message('validaArquivo', 'O campo Imagem obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function _createThumbnail($fileName) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'uploads/pasta_vid/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 140;
		$config['height'] = 80;
		

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 
	
	function manter() 
	{
		
		$this->form_validation->set_rules('titulo', 'Nome do Vídeo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao','required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}
		$this->form_validation->set_rules('link', 'Link', 'required');
				
		$eventoPost['row'] = $_POST;
		
		$eventoPost['secretarias'] = $this->SecretariaModel->secretarias();
		$eventoPost['videos_gerais'] = $this->VideosModel->videos_gerais();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/videos', $eventoPost);
		} else {
			$video = array(
				'titulo' => $this->input->post('titulo'),
				'descricao' => $this->input->post('descricao'),
				'link' => $this->input->post('link')
			);
			
			if (isset($_FILES ['userfile']['name']))
			{
				// Load the library - no config specified here
				$this->load->library('upload');
		 
				// Check if there was a file uploaded - there are other ways to
				// check this such as checking the 'error' for the file - if error
				// is 0, you are good to code
				if (!empty($_FILES['userfile']['name']))
				{
					// Specify configuration for File 1
					$config['upload_path'] = 'uploads/pasta_vid/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '1024';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';      
		 
					// Initialize config for File 1
					$this->upload->initialize($config);
		 
					// Upload file 1
					if ($this->upload->do_upload('userfile'))
					{
						$data = $this->upload->data();
						
						$this->_createThumbnail($_FILES['userfile']['name']);
						$this->image_lib->clear();
						//}
						$video['capa_video_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$video['capa_video'] = $data ['raw_name'] . $data ['file_ext'];	
				}

				else
				{
					echo $this->upload->display_errors();
				}
		 
			}
			}
			
			//print_r($video);
			//die();
			
			
			$idvideo = $this->input->post('id');
			if($idvideo){				
				$this->VideosModel->update($idvideo, $video);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->VideosModel->insert($video);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			$var['videos_gerais'] = $this->VideosModel->videos_gerais();
			$var['secretarias'] = $this->SecretariaModel->secretarias();
			
			$this->load->view('admin/videos', $var);
		}	
	}
	
}
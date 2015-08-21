<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/albummodel',"AlbumModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");

	}

	public function index()
	{		
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['paginas'] = $this->AlbumModel->paginas();
		$this->load->view('admin/album', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
			$var['alb'] = $this->AlbumModel->detalhar($id);
			$var['album_todos'] = $this->AlbumModel->album_todos();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			$var['paginas'] = $this->AlbumModel->paginas();
		}
		$this->load->view('admin/album', $var);
	}
	
	function deletar($id) 
	{
		$this->AlbumModel->deletar($id);
		$var['paginas'] = $this->AlbumModel->paginas();
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/album', $var);
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
		$config['source_image'] = 'uploads/pasta_alb/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 160;
		$config['height'] = 130;
		

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 
	
	function manter() 
	{
		//$this->form_validation->set_rules('id_categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('id_pagina', 'Página', 'required');
		$this->form_validation->set_rules('titulo', 'Nome do Álbum', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição','required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}		
		$albumPost['alb'] = $_POST;
		
		$albumPost['paginas'] = $this->AlbumModel->paginas();
		$albumPost['album_todos'] = $this->AlbumModel->album_todos();
		$albumPost['categorias'] = $this->CategoriaModel->categoria_todas();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/album', $albumPost);
		} else {
			$album = array(	
				'id_categoria' => $this->input->post('id_categoria'),
				'id_pagina' => $this->input->post('id_pagina'),
				'titulo' => $this->input->post('titulo'),
				'descricao' => $this->input->post('descricao')
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
					$config['upload_path'] = 'uploads/pasta_alb/';
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
						$album['capa_album_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$album['capa_album'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}
			
			$idalbum = $this->input->post('id');
			if($idalbum){				
				$this->AlbumModel->update($idalbum, $album);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->AlbumModel->insert($album);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			$var['album_todos'] = $this->AlbumModel->album_todos();
			$var['paginas'] = $this->AlbumModel->paginas();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			
			$this->load->view('admin/album', $var);
		}	
	}
	
}
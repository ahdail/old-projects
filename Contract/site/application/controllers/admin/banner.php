<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/bannermodel',"BannerModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");

	}

	public function index()
	{		
		$var['categorias'] = $this->CategoriaModel->categoria_todas();			
		$this->load->view('admin/banner', $var);
	}
	
	function detalhar($id=0) 
	{
		
		//echo $id;
		//die();
		
		if ($id) {
			$var['ban'] = $this->BannerModel ->detalhar($id);
			$var['banner_todos'] = $this->BannerModel ->banner_todos();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();		
		}
		$this->load->view('admin/banner', $var);
	}
	
	function deletar($id) 
	{
		$this->BannerModel->deletar($id);
		$var['categorias'] = $this->CategoriaModel->categoria_todas();		
		$var['banner_todos'] = $this->BannerModel->banner_todos();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/banner', $var);
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
		$config['source_image'] = 'banners/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 193;
		$config['height'] = 104;
		

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 
	
	function manter() 
	{
		
		$this->form_validation->set_rules('titulo', 'Nome do Banner', 'required');
		//$this->form_validation->set_rules('descricao', 'Descrição','required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}		
		$bannerPost['alb'] = $_POST;
		
		$bannerPost['categorias'] = $this->CategoriaModel->categoria_todas();		
		$bannerPost['banner_todos'] = $this->BannerModel->banner_todos();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/banner', $bannerPost);
		} else {
			$banner = array(				
				'titulo' => $this->input->post('titulo'),
				'exibir' => $this->input->post('exibir')				
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
					$config['upload_path'] = 'banners/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '1024';
					$config['max_width']  = '600';
					$config['max_height']  = '400';      
		 
					// Initialize config for File 1
					$this->upload->initialize($config);
		 
					// Upload file 1
					if ($this->upload->do_upload('userfile'))
					{
						$data = $this->upload->data();
						
						$this->_createThumbnail($_FILES['userfile']['name']);
						$this->image_lib->clear();
						//}
						$banner['imagem_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$banner['imagem'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}
			
			$idbanner = $this->input->post('id');
			if($idbanner){				
				$this->BannerModel->update($idbanner, $banner);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->BannerModel->insert($banner);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			$var['banner_todos'] = $this->BannerModel->banner_todos();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();		
			
			$this->load->view('admin/banner', $var);
		}	
	}
	
}
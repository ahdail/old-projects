<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		
		
		$this->load->model('admin/categoriamodel',"CategoriaModel");
	}

	public function index()
	{		
		$var['categorias'] = $this->CategoriaModel->categoria_todas();		
		$this->load->view('admin/categoria', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['cat'] = $this->CategoriaModel->detalhar($id);			
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
		}
		$this->load->view('admin/categoria', $var);
	}
	
	function deletar($id) 
	{
		$this->CategoriaModel->deletar($id);
		$var['categorias'] = $this->CategoriaModel->categoria_todas();		
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/categoria', $var);
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
		$config['source_image'] = 'uploads/pasta_cat/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 100;
		$config['height'] = 100;

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 

	function manter() 
	{			
		$this->form_validation->set_rules('nome_categoria', 'Nome da Categoria', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição','required');
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
				
		$categoriaPost['cat'] = $_POST;
		$categoriaPost['categorias'] = $this->CategoriaModel->categoria_todas();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/categoria', $categoriaPost);
		} else {
			$categoria = array(
				'nome_categoria' => $this->input->post('nome_categoria'),
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
					$config['upload_path'] = 'uploads/pasta_cat/';
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
						//$this->image_lib->clear();
						//}
						$categoria['imagem_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$categoria['imagem'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}

			$idcategoria = $this->input->post('id');
			if($idcategoria){				
				$this->CategoriaModel->update($idcategoria, $categoria);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->CategoriaModel->insert($categoria);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			/**
			$configList = array(
				'base_url' 		=> site_url('/admin/noticia/manter/'),
				'per_page' 		=> 2,
				'total_rows' 	=> $this->NoticiaModel->getTotal(),
				'uri_segment' 	=> 4,
				'cur_tag_open'	=> '<span class="current">',
				'cur_tag_close'	=> '</span>',
				'first_link' 	=> '« Primeira',
				'last_link' 	=> 'Última »'
			);
					
			$query = $this->NoticiaModel->exibir($start, $configList['per_page']);
			$this->pagination->initialize($configList);
			$var['pag'] = $this->pagination->create_links();
			
			print_r($var['pag']);
			die();
			
			$var['noticias_todas'] = $query->result_array();
			
			***/
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			
			$this->load->view('admin/categoria', $var);
		}	
	}
	
	
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticia extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		
		$this->load->model('admin/noticiamodel',"NoticiaModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");
	}

	public function index()
	{		
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();
		$this->load->view('admin/noticia', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['not'] = $this->NoticiaModel->detalhar($id);
			$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
		}
		$this->load->view('admin/noticia', $var);
	}
	
	function deletar($id) 
	{
		$this->NoticiaModel->deletar($id);
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/noticia', $var);
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
		$config['source_image'] = 'uploads/pasta_not/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 100;
		$config['height'] = 100;

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 

	function manter() 
	{
		
		if(!empty($_POST['data'])){
			$divi = explode("/", $_POST['data']);
			$data_sql = $divi[2]."-".$divi[1]."-".$divi[0];
		}
		
		//$this->form_validation->set_rules('id_secretaria', 'Exibir em?', 'required');
		$this->form_validation->set_rules('titulo', 'Titulo da Notícia', 'required');
		$this->form_validation->set_rules('data', 'Data da Publicação','required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}
		$this->form_validation->set_rules('resumo', 'Resumo da Notícia', 'required');
		$this->form_validation->set_rules('fonte', 'Fonte da Notícia', 'required');
				
		$noticiaPost['not'] = $_POST;
		$noticiaPost['not']['data'] = $data_sql;
		
		
		$noticiaPost['categorias'] = $this->CategoriaModel->categoria_todas();
		$noticiaPost['noticias_todas'] = $this->NoticiaModel->noticias_todas();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/noticia', $noticiaPost);
		} else {
			$noticia = array(
				'id_categoria' => $this->input->post('id_categoria'),
				'titulo' => $this->input->post('titulo'),
				'data' => $data_sql,
				'resumo' => $this->input->post('resumo'),
				'conteudo' => $this->input->post('conteudo'),
				'fonte' => $this->input->post('fonte'),
				'destaque' => $this->input->post('destaque')
				
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
					$config['upload_path'] = 'uploads/pasta_not/';
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
						$noticia['imagem_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$noticia['imagem'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}

			$idnoticia = $this->input->post('id');
			if($idnoticia){				
				$this->NoticiaModel->update($idnoticia, $noticia);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->NoticiaModel->insert($noticia);
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
			$var['noticias_todas'] = $this->NoticiaModel->noticias_todas();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			
			$this->load->view('admin/noticia', $var);
		}	
	}
	
	
	
}
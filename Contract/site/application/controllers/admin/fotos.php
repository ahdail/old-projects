<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotos extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/fotosmodel',"FotosModel");
		$this->load->model('admin/albummodel',"AlbumModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");

	}

	public function index()
	{		
		$this->manter();
	}
	
	public function pesquisar()
	{		
	
		$this->form_validation->set_rules('id_album', 'Álbum', 'required');
		
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['album_todos'] = $this->AlbumModel->album_todos();
		
		if ($this->form_validation->run() == FALSE){
			$var['display'] = "none";
			$this->load->view('admin/fotos_album', $var);
		} else {
			$var['fot'] = $this->AlbumModel->detalhar($_POST['id_album']);
			$var['fotos_todas'] = $this->FotosModel->fotos_album($_POST['id_album']);			
			$var['display'] = "block";
			
			$this->load->view('admin/fotos_album', $var);
		
		}
		
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
			$var['fot'] = $this->FotosModel->detalhar($id);
			$var['fotos_todas'] = $this->FotosModel->fotos_todas();
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			$var['album_todos'] = $this->AlbumModel->album_todos();
			$var['NovaOK'] = "new";
			
		}
		$var['display'] = "none";
		
		$this->load->view('admin/fotos_album', $var);
	}
	
	function deletar($id, $id_album) 
	{
		$this->FotosModel->deletar($id);
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['fotos_todas'] = $this->FotosModel->fotos_album($id_album);
		$var['fot'] = $this->FotosModel->fotos_album($id_album);
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['excluirOK'] = "Excluído com sucesso!";
		$var['NovaOK'] = "new";
		$var['display'] = "block";
		$this->load->view('admin/fotos_album', $var);
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
		$config['source_image'] = 'uploads/pasta_fot/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 120;
		$config['height'] = 120;
		
		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 
	
	function nova(){
	
		$var['categorias'] = $this->CategoriaModel->categoria_todas();
		$var['fotos_todas'] = $this->FotosModel->fotos_todas();
		$var['album_todos'] = $this->AlbumModel->album_todos();
		$var['NovaOK'] = "new";
		$var['display'] = "none";
		$this->load->view('admin/fotos_album', $var);
		
	}
	
	function manter() 
	{

		//print_r($_POST);
		//print_r($_FILES);
		//die();
		
		$this->form_validation->set_rules('id_album', 'Álbum', 'required');
		//$this->form_validation->set_rules('descricao', 'Descrição','required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}		
		$fotosPost['fot'] = $_POST;
		$fotosPost['album_todos'] = $this->AlbumModel->album_todos();
		$fotosPost['categorias'] = $this->CategoriaModel->categoria_todas();
		$fotosPost['fotos_todas'] = $this->FotosModel->fotos_todas();
		
		$fotosPost['NovaOK'] = "new";
		$fotosPost['display'] = "none";
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/fotos_album', $fotosPost);
		} else {
			$foto = array(				
				'id_album' => $this->input->post('id_album'),				
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
					$config['upload_path'] = 'uploads/pasta_fot/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '1024'; //1MB
					$config['max_width']  = '1000';
					$config['max_height']  = '600';      
		 
					// Initialize config for File 1
					$this->upload->initialize($config);
		 
					// Upload file 1
					if ($this->upload->do_upload('userfile'))
					{
						$data = $this->upload->data();
						
						$this->_createThumbnail($_FILES['userfile']['name']);
						$this->image_lib->clear();
						//}
						$foto['foto_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];	
						$foto['foto'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}
			
			$idfoto = $this->input->post('id');
			if($idfoto){				
				$this->FotosModel->update($idfoto, $foto);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
				
			} else {				
				$this->FotosModel->insert($foto);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
				
				$var['NovaOK'] = "new";
				
			} 
			
			
			$var['categorias'] = $this->CategoriaModel->categoria_todas();
			$var['album_todos'] = $this->AlbumModel->album_todos();
			$var['fot'] = $this->FotosModel->fotos_album($this->input->post('id_album'));
			$var['fotos_todas'] = $this->FotosModel->fotos_album($this->input->post('id_album'));
			$var['display'] = "block";	
				
			$this->load->view('admin/fotos_album', $var);
		}	
	}
	
}
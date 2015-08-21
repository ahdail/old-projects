<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secretaria extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		
		$this->load->model('admin/secretariasmodel',"SecretariaModel");

	}

	public function index()
	{		
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$this->load->view('admin/secretaria', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['sec'] = $this->SecretariaModel->detalhar($id);			
			$var['secretarias'] = $this->SecretariaModel->secretarias();
		}
		
		//print_r($var['sec']);
		//die();
		$this->load->view('admin/secretaria', $var);
	}
	
	function deletar($id) 
	{
		$this->SecretariaModel->deletar($id);
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/secretaria', $var);
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
		$config['source_image'] = 'uploads/pasta_sec/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 100;
		$config['height'] = 115;
		

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	} 
	
	function manter() 
	{
		
		//print_r($_POST);
		//print_r($_FILES);
		//die();
		
		$this->form_validation->set_rules('nome_secretaria', 'Nome da Secretaria', 'trim|required');
		$this->form_validation->set_rules('nome_responsavel', 'Nome do Secretário','trim|required');
		//if (!$this->input->post('id')) {
			//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		//}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
		$this->form_validation->set_rules('descricao_responsavel', 'Descrição da Secretaria', 'trim|required');
				
		$secretariaPost['sec'] = $_POST;
		//$secretariaPost['sec']['imagem_responsavel_thumb'] =  $_POST['imagem_responsavel_thumb'] ;
		//print_r($secretariaPost['sec']);
		
		//die();
		
		$secretariaPost['secretarias'] = $this->SecretariaModel->secretarias();
		
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/secretaria', $secretariaPost);
		} else {
			$secretaria = array(
				'nome_secretaria' => $this->input->post('nome_secretaria'),
				'nome_responsavel' => $this->input->post('nome_responsavel'),
				'email' => $this->input->post('email'),
				'telefone' => $this->input->post('telefone'),
				'descricao_responsavel' => $this->input->post('descricao_responsavel'),			
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
					$config['upload_path'] = 'uploads/pasta_sec/';
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
						$secretaria ['imagem_responsavel_thumb'] = $data ['raw_name']."_thumb".$data ['file_ext'];
						$secretaria ['imagem_responsavel'] = $data ['raw_name'] . $data ['file_ext'];	
					}

					else
					{
						echo $this->upload->display_errors();
					}
		 
				}
			}
			
			$idesecretaria = $this->input->post('id');
			if($idesecretaria){				
				$this->SecretariaModel->update($idesecretaria, $secretaria);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->SecretariaModel->insert($secretaria);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			$var['secretarias'] = $this->SecretariaModel->secretarias();
			
			$this->load->view('admin/secretaria', $var);
		}	
	}
	
}
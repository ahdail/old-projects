<?php
class Babayaga extends Controller {

	function __construct() 
	{
		parent::Controller();		
		$this->load->helper(array('form', 'url', 'login', 'data'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));		
		$this->load->model('admin/perfilbabayagamodel',"PerfilBabayagaModel");
	}
	
	function index() 
	{		
		$this->load->view('admin/perfilbabayagamanter', $perfilbabayaga);
	}
	
	function listar($start = 0)  
	{

		$config = array(
    		'base_url' 		=> site_url('/admin/perfilbabayaga/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->PerfilBabayagaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
                
        $query = $this->PerfilBabayagaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $perfilbabayaga['pag'] = $this->pagination->create_links();
        $perfilbabayaga['perfilbabayaga'] = $query->result_array();
		
		$this->load->view('admin/perfilbabayagalistar', $perfilbabayaga);
	}

	function detalhar($id=0) 
	{
		if ($id) {
	    	$perfilbabayaga['row'] = $this->PerfilBabayagaModel->detalhar($id);
		}
		$this->load->view('admin/perfilbabayagamanter', $perfilbabayaga);
	}
	
	function deletar($id) 
	{		
		$this->PerfilBabayagaModel->deletar($id);
		Babayaga::listar();
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo й obrigatуrio');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('cliente', 'Cliente', 'required');
		$this->form_validation->set_rules('descricao', 'Descriзгo', 'required');
		
		$perfilbabayagaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/perfilbabayagamanter', $perfilbabayagaPost);
		} else {
			$perfilbabayaga = array(
				'cliente' => $this->input->post('cliente'),	
				'descricao' => $this->input->post('descricao'),	
				'resumo' => $this->input->post('resumo'),
				'data' => date("Y-m-d")
			);
			
		// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/perfilbabayaga';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/perfilbabayagamanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/perfilbabayaga',
						'maintain_ratio' => true,
						'width' => 112,
					    'height' => 112,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$perfilbabayaga ['fotoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$perfilbabayaga ['foto'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
					
			$idperfilbabayaga = $this->input->post('id');
			if($idperfilbabayaga){
				
				$this->PerfilBabayagaModel->update($idperfilbabayaga, $perfilbabayaga);
			} else {
				$this->PerfilBabayagaModel->insert($perfilbabayaga);
			} 
			Babayaga::listar();
		}
	}
}
?>
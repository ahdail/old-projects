<?php
class Apoio extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
	}
	function index() 
	{
		$this->load->view('admin/apoiolistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/apoio/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ApoioModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> '�ltima >>'
    	);
                
        $query = $this->ApoioModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $apoio['pag'] = $this->pagination->create_links();
        $apoio['apoio'] = $query->result_array();
		
		$this->load->view('admin/apoiolistar',$apoio);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$apoio['row'] = $this->ApoioModel->detalhar($id);
		}
		$this->load->view('admin/apoiomanter', $apoio);
	}
	
	function deletar($id) 
	{
		$this->ApoioModel->deletar($id);
		Apoio::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'nome', 'required');
		$this->form_validation->set_rules('informacao', 'Informação', 'required');
		$this->form_validation->set_rules('mostrar', 'Mostrar', 'required');
		
						
		$apoioPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/apoiomanter', $apoioPost);
		} else {
			$apoio = array(
				'nome' 			=> $this->input->post('nome'),
				'informacao' 	=> $this->input->post('informacao'),
				'exibir_em' 	=> $this->input->post('exibir_em'),
				'mostrar' 		=> $this->input->post('mostrar'),								
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/parceiros';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/videomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/parceiros',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 60,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$apoio ['imagem_pq'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];
					$apoio ['imagem'] = $data ['raw_name'] . $data ['file_ext'];					
					
				}
			}
			
			$idapoio = $this->input->post('id');
			if($idapoio){		
				$this->ApoioModel->update($idapoio, $apoio);
			} else {						
				$this->ApoioModel->insert($apoio);
			} 
			Apoio::listar();
		}	
	}
}
?>
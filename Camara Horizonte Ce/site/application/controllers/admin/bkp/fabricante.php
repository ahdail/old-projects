<?php
class Fabricante extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','funcoes', 'pagination'));
		$this->load->model('admin/fabricantemodel',"FabricanteModel");
	}
	function index() 
	{
		$this->load->view('admin/fabricantemanter');
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$fabricante['row'] = $this->FabricanteModel->detalhar($id);
		}
		
		$this->load->view('admin/fabricantemanter',$fabricante);
	}
	
	function deletar($id) 
	{
		$this->FabricanteModel->deletar($id);
		FabricanteModel::listar();		
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('nome', 'Fabricante', 'required');
				
		$fabricantePost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){			
			$this->load->view('admin/fabricantemanter', $fabricantePost);
		} else {
			$fabricante = array(				
				'nome' => $this->input->post('nome')
			);
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/img';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/fabricantemanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/img',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 100,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$fabricante ['thumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					$fabricante ['img'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			
			$idfabricante = $this->input->post('id');
			if($idfabricante){
				$this->FabricanteModel->update($idfabricante, $fabricante);
			} else {				
				$this->FabricanteModel->insert($fabricante);
			} 
			
			Fabricante::listar();
		}		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/fabricante/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->FabricanteModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->FabricanteModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $fabricante['pag'] = $this->pagination->create_links();
        $fabricante['fabricante'] = $query->result_array();

		$this->load->view('admin/fabricantelistar',$fabricante);
	}

	
}
?>
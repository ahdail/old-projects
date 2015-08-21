<?php
class Parceiro extends Controller {

	function __construct() 
	{
		parent::Controller();		
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));		
		$this->load->model('admin/parceiromodel',"ParceiroModel");
	}
	
	function index() 
	{				
		$this->load->view('admin/parceiromanter', $colecoes);
	}
	
	function listar($start = 0)  
	{

		$config = array(
    		'base_url' 		=> site_url('/admin/parceiro/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ParceiroModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ParceiroModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $parceiro['pag'] = $this->pagination->create_links();
        $parceiro['parceiro'] = $query->result_array();
		
		$this->load->view('admin/parceirolistar', $parceiro);
	}

	function detalhar($id=0) 
	{
		if ($id) {
	    	$parceiro['row'] = $this->ParceiroModel->detalhar($id);
		}
		$this->load->view('admin/parceiromanter', $parceiro);
	}
	
	function deletar($id) 
	{	
		$this->ParceiroModel->deletar($id);
		Parceiro::listar();
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
		$this->form_validation->set_rules('nome', 'Nome do Parceiro', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		
		$parceiroPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/parceiromanter', $parceiroPost);
		} else {
			$parceiro = array(
				'nome' 			=> $this->input->post('nome'),	
				'descricao' 	=> $this->input->post('descricao'),	
				'site' 			=> $this->input->post('site')					
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
					$this->load->view ('admin/parceiromanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					
					
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/parceiros',
						'maintain_ratio' => true,
						'width' => 150,
					    'height' => 150,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$parceiro ['fotoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$parceiro ['foto'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
						
			$idparceiro = $this->input->post('id');
			if($idparceiro){				
				$this->ParceiroModel->update($idparceiro, $parceiro);
			} else {				
				$this->ParceiroModel->insert($parceiro);
			} 
			Parceiro::listar();
		}
	}
}
?>
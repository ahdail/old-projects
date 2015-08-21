<?php
class Vereadores extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/vereadoresmodel',"VereadoresModel");
	}
	function index() 
	{
		$vereadores['partidos'] = $this->VereadoresModel->partidos();
		$this->load->view('admin/vereadoresmanter', $vereadores);
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/vereadores/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->VereadoresModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->VereadoresModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $vereadores['pag'] = $this->pagination->create_links();
        $vereadores['vereadores'] = $query->result_array();
		
		$this->load->view('admin/vereadoreslistar',$vereadores);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$vereadores['row'] = $this->VereadoresModel->detalhar($id);
		}
		$vereadores['partidos'] = $this->VereadoresModel->partidos();
		$this->load->view('admin/vereadoresmanter', $vereadores);
	}
	
	function deletar($id) 
	{
		$this->VereadoresModel->deletar($id);
		Vereadores::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'nome', 'required');
		$this->form_validation->set_rules('informacao', 'Informação', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		
						
		$vereadoresPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$vereadoresPost['partidos'] = $this->VereadoresModel->partidos();
			$this->load->view('admin/vereadoresmanter', $vereadoresPost);
		} else {
			$vereadores = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'informacao' 	=> $this->input->post('informacao'),
				'id_partido' 	=> $this->input->post('id_partido'),
				'presidente' 	=> $this->input->post('presidente'),
				'mesa_diretora'	=> $this->input->post('mesa_diretora'),								
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/foto_vereadores';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '10000';
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
						'new_image' => $this->gallery_path . 'site/foto_vereadores',
						'maintain_ratio' => true,
						'width' => 55,
					    'height' => 55,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$vereadores ['imagem'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$vereadores ['imagem_gd'] = $data ['raw_name'] . $data ['file_ext'];					
					
				}
			}
						
			$idvereadores = $this->input->post('id');
			if($idvereadores){			
				$this->VereadoresModel->update($idvereadores, $vereadores);
			} else {						
				$this->VereadoresModel->insert($vereadores);
			} 
			Vereadores::listar();
		}	
	}
}
?>
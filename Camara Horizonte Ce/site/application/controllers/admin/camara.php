<?php
class Camara extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/camaramodel',"CamaraModel");
	}
	function index() 
	{
		$this->load->view('admin/camaralistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/camara/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->CamaraModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '« Primeira',
    		'last_link' 	=> 'Última »'
    	);
                
        $query = $this->CamaraModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $camara['pag'] = $this->pagination->create_links();
        $camara['camara'] = $query->result_array();
		
		$this->load->view('admin/camaralistar',$camara);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$camara['row'] = $this->CamaraModel->detalhar($id);
		}
		$this->load->view('admin/camaramanter',$camara);
	}
	
	function deletar($id) 
	{
		$this->CamaraModel->deletar($id);
		Camara::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricão', 'required');
		
				
		$camaraPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/camaramanter', $camaraPost);
		} else {
			$camara = array(
				'titulo'	=> $this->input->post('titulo'),
				'descricao' => $this->input->post('descricao'),				
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
					$this->load->view ('admin/videomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/img',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 70,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$camara ['imagem_pq'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$camara ['imagem'] = $data ['raw_name'] . $data ['file_ext'];					
					
				}
			}
		
			$idcamara = $this->input->post('id');
			if($idcamara){	
				$this->CamaraModel->update($idcamara, $camara);
			} else {						
				$this->CamaraModel->insert($camara);
			} 
			Camara::listar();
		}	
	}
}
?>
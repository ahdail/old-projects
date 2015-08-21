<?php
class Lei extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
	}
	function index() 
	{
		//$legislacao['partidos'] = $this->LegislacaoModel->partidos();
		$this->load->view('admin/legislacaomanter', $legislacao);
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/legislacao/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->LegislacaoModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->LegislacaoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $legislacao['pag'] = $this->pagination->create_links();
        $legislacao['legislacao'] = $query->result_array();
		
		$this->load->view('admin/legislacaolistar',$legislacao);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$legislacao['row'] = $this->LegislacaoModel->detalhar($id);
		}
		$legislacao['partidos'] = $this->LegislacaoModel->partidos();
		$this->load->view('admin/legislacaomanter', $legislacao);
	}
	
	function deletar($id) 
	{
		$this->LegislacaoModel->deletar($id);
		Lei::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('exibir_em', 'Exibir em', 'required');
		
						
		$legislacaoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/legislacaomanter', $legislacaoPost);
		} else {
			$legislacao = array(
				'titulo' 		=> $this->input->post('titulo'),
				'descricao' 	=> $this->input->post('descricao'),
				'exibir_em' 	=> $this->input->post('exibir_em'),									
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/documentos';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|';
				$config['allowed_types'] = 'word|pdf|docx';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());					
					$this->load->view ('admin/transparenciamanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
										
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$legislacao ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];								
					
				}
				
				
				
				
				
			}
			
			
			


				
			$idlegislacao = $this->input->post('id');
			if($idlegislacao){			
				$this->LegislacaoModel->update($idlegislacao, $legislacao);
			} else {						
				$this->LegislacaoModel->insert($legislacao);
			} 
			Lei::listar();
		}	
	}
}
?>
<?php
class Evento extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date','data', 'login'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
		$this->load->model('admin/eventoModel',"EventoModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index()
	{
		Evento::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/evento/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->EventoModel->getTotal(),
    		'uri_segment'	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
    	
    	$query = $this->EventoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $evento['pag'] = $this->pagination->create_links();
        $evento['evento'] = $query->result_array();
        $this->load->view('admin/eventolistar',$evento);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$evento['row'] = $this->EventoModel->detalhar($id);
	       	$data = $this->EventoModel->exibirData($id);
	    	$evento['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$this->load->view('admin/eventomanter', $evento);
	}
	
	function deletar($id)
	{
		$this->EventoModel->deletar($id);
		Evento::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('descricao', 'Descriчуo', 'required');
		
		$eventoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/eventomanter',$eventoPost);
		} else {
			$data = $this->input->post('data');
			$data_nova = $this->funcoes->converte_data($data);
			$evento = array(
				'titulo' => $this->input->post('titulo'),
				'data' => $data_nova,
				'descricao' => $this->input->post('descricao')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/eventos_fotos';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/eventomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/eventos_fotos',
						'maintain_ratio' => true,
						'width' => 165,
					    'height' => 110,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$evento ['fotoEventoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					//$evento ['fotoEvento'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			
			
			
			
			$idEvento = $this->input->post('id');
			if($idEvento){
				$this->EventoModel->update($idEvento, $evento);				
			} else {
				$this->EventoModel->insert($evento);				
			} 
			Evento::listar();
		}
	}
}
?>
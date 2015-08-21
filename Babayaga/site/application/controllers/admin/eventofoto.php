<?php
class EventoFoto extends Controller {

	function __construct() 
	{
		parent::Controller();		
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/eventomodel',"EventoModel");
		$this->load->model('admin/eventofotomodel',"EventoFotoModel");
	}
	function index() 
	{		
		$eventos['evento'] = $this->EventoModel->todosEventos();		
		$this->load->view('admin/eventofotomanter', $eventos);
	}

	function pesquisar()
	{
		$eventos['evento'] = $this->EventoModel->todosEventos();
		$this->load->view('admin/eventofotolistar', $eventos);
	}
	
	function listar($start = 0 )  
	{
		$idevento = $this->input->post('idevento');
		
		$config = array(
    		'base_url' 		=> site_url('/admin/eventofoto/listar/'.$idevento.''),
    		'per_page' 		=> 100,
    		'total_rows' 	=> $this->EventoFotoModel->getTotal($idevento),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->EventoFotoModel->exibir($start, $config['per_page'], $idevento);
        $this->pagination->initialize($config);
        $eventofoto['pag'] = $this->pagination->create_links();
        $eventofoto['eventofoto'] = $query->result_array();
		$eventofoto['evento'] = $this->EventoModel->todosEventos();

		$this->load->view('admin/eventofotolistar', $eventofoto);
	}

	function detalhar($id=0) 
	{
		if ($id) {
	    	$eventofoto['row'] = $this->EventoFotoModel->detalhar($id);
		}
		
		$eventofoto['evento'] = $this->EventoModel->todosEventos();
		$this->load->view('admin/eventofotomanter', $eventofoto);
	}

	function deletar($id)
	{
		$this->EventoFotoModel->deletar($id);
		EventoFoto::listar();
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

		$this->form_validation->set_rules('idevento', 'Evento', 'required');
		
		$eventoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/eventofotomanter', $eventoPost);
		} else {
			$eventofoto = array(
				'idEvento' => $this->input->post('idevento')				
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
					$this->load->view ('admin/eventofotomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/eventos_fotos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 100,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$eventofoto ['fotoEventoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					$eventofoto ['fotoEvento'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}

		
			$idevento = $this->input->post('id');
			if($idevento){				
				$this->EventoFotoModel->update($idevento, $eventofoto);
			} else {		
				$this->EventoFotoModel->insert($eventofoto);
			} 
			EventoFoto::listar();
		}
	}
}
?>
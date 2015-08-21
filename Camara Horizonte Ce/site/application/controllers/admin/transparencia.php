<?php
class Transparencia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/transparenciamodel',"TransparenciaModel");
	}
	function index() 
	{
		Transparencia::listar();	
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$transparencia['row'] = $this->TransparenciaModel->detalhar($id);
		}
		
		$this->load->view('admin/transparenciamanter', $transparencia);
	}
	
	function deletar($id) 
	{
		$this->TransparenciaModel->deletar($id);
		Transparencia::listar();
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo Arquivo é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() 
	{
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');

		
		$transparenciaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){			
			$this->load->view('admin/transparenciamanter', $transparenciaPost);
		} else {
			$transparencia = array(								
				'titulo'	=> $this->input->post('titulo'),
				'descricao'	=> $this->input->post('descricao'),				
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/doctransparencia';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|doc|pdf';
				//$config['allowed_types'] = 'word|pdf|docx';
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
					
					//$transparencia ['thumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$transparencia ['doc'] = $data ['raw_name'] . $data ['file_ext'];								
					
				}
			}
				
			$idtransparencia = $this->input->post('id');
			if($idtransparencia){			
				$this->TransparenciaModel->update($idtransparencia, $transparencia);
			} else {						
				$this->TransparenciaModel->insert($transparencia);
			} 
			Transparencia::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/transparencia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->TransparenciaModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->TransparenciaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $transparencia['pag'] = $this->pagination->create_links();
        $transparencia['transparencia'] = $query->result_array();
		
		$this->load->view('admin/transparencialistar',$transparencia);
	}
	
}
?>
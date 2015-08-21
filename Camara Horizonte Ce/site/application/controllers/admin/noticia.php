<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/noticiamodel',"NoticiaModel");
	}
	function index() 
	{
		$this->load->view('admin/noticialistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/noticia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NoticiaModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '« Primeira',
    		'last_link' 	=> 'Última »'
    	);
                
        $query = $this->NoticiaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $noticia['pag'] = $this->pagination->create_links();
        $noticia['noticia'] = $query->result_array();
		
		$this->load->view('admin/noticialistar',$noticia);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$noticia['row'] = $this->NoticiaModel->detalhar($id);
		}
		$this->load->view('admin/noticiamanter',$noticia);
	}
	
	function deletar($id) 
	{
		$this->NoticiaModel->deletar($id);
		Noticia::listar();
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if ($this->input->post('destaque')) {
			$this->form_validation->set_message('validaArquivo', 'O campo Imagem obrigatÃ³rio');
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
		$this->form_validation->set_rules('noticia', 'Noticia', 'required');
		
				
		$noticiaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/noticiamanter', $noticiaPost);
		} else {
			$noticia = array(
				'titulo' 			=> $this->input->post('titulo'),
				'resumo' 			=> $this->input->post('resumo'),
				'noticia' 			=> $this->input->post('noticia'),
				'destaque' 			=> $this->input->post('destaque'),
				'materia_especial'	=> $this->input->post('materia_especial'),				
				'data' 				=> date("Y-m-d"),
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
					    'height' => 60,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$noticia ['imagem'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					
				}
			}
						
			$idnoticia = $this->input->post('id');
			if($idnoticia){	
				$this->NoticiaModel->update($idnoticia, $noticia);
			} else {						
				$this->NoticiaModel->insert($noticia);
			} 
			Noticia::listar();
		}	
	}
}
?>
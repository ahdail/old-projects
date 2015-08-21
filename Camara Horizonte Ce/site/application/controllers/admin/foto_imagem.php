<?php
class Foto_Imagem extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/foto_imagemmodel',"Foto_ImagemModel");
	}
	function index() 
	{
		$foto_imagem['albuns'] = $this->Foto_ImagemModel->albuns($id);
		$this->load->view('admin/foto_imagemmanter', $foto_imagem);		
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$foto_imagem['row'] = $this->Foto_ImagemModel->detalhar($id);
		}
		$foto_imagem['albuns'] = $this->Foto_ImagemModel->albuns($id);
		$this->load->view('admin/foto_imagemmanter', $foto_imagem);
	}
	
	function deletar($id) 
	{
		$this->Foto_ImagemModel->deletar($id);
		Foto_Imagem::listar();
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo Foto é obrigatório');
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
		$this->form_validation->set_rules('id_album', 'Album', 'required');	
		$this->form_validation->set_rules('mostrar', 'Mostrar no site', 'required');

		
		$foto_imagemPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$foto_imagemPost['albuns'] = $this->Foto_ImagemModel->albuns($id);
			$this->load->view('admin/foto_imagemmanter', $foto_imagemPost);
		} else {
			$foto_imagem = array(
				'id_album'	=> $this->input->post('id_album'),				
				'exibir'	=> $this->input->post('exibir'),
				'mostrar'	=> $this->input->post('mostrar'),				
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/galeria_fotos';
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
						'new_image' => $this->gallery_path . 'site/galeria_fotos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 60,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$foto_imagem ['imagem'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					
				}
			}
				
			$idfoto_imagem = $this->input->post('id');
			if($idfoto_imagem){			
				$this->Foto_ImagemModel->update($idfoto_imagem, $foto_imagem);
			} else {						
				$this->Foto_ImagemModel->insert($foto_imagem);
			} 
			Foto_Imagem::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/foto_imagem/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->Foto_ImagemModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> '�ltima >>'
    	);
                
        $query = $this->Foto_ImagemModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $foto_imagem['pag'] = $this->pagination->create_links();
        $foto_imagem['foto_imagem'] = $query->result_array();
		
		$this->load->view('admin/foto_imagemlistar',$foto_imagem);
	}
	
}
?>
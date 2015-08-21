<?php
class Video extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper( array ('form', 'url','date','login'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
		$this->load->model('admin/videomodel',"VideoModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index()
	{
		Video::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/video/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->VideoModel->getTotal(),
    		'uri_segment'	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
    	
    	$query = $this->VideoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $video['pag'] = $this->pagination->create_links();
        $video['video'] = $query->result_array();
        $this->load->view('admin/videolistar',$video);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$video['row'] = $this->VideoModel->detalhar($id);
		} 
		$this->load->view('admin/videomanter', $video);
	}
	
	function deletar($id)
	{
		// Log
		$video['row'] = $this->VideoModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $video['row']['titulo'], $video['row']['id'], "Excluiu [EVENTO]");
		$this->auditoria->gravar();
		
		$this->VideoModel->deletar($id);
		Video::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('linkvideo', 'Link do Vнdeo', 'required');
		$this->form_validation->set_rules('descricao', 'Descriзгo', 'required');
		
		$videoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/videomanter',$videoPost);
		} else {
			$video = array(
				'titulo' => $this->input->post('titulo'),
				'linkvideo' => $this->input->post('linkvideo'),
				'descricao' => $this->input->post('descricao')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/video_fotos';
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
						'new_image' => $this->gallery_path . 'site/video_fotos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 60,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$video ['fotoVideoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					//$evento ['fotoEvento'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			
			
			// Parвmetros utilizados na gravaзгo do Log
			
			$idvideo = $this->input->post('id');
			if($idvideo){
				$this->VideoModel->update($idvideo, $video);
				
			} else {
				$this->VideoModel->insert($video);
				
			} 
			Video::listar();
		}
	}
}
?>
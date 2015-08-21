<?php
class Foto_Album extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/foto_albummodel',"Foto_AlbumModel");
	}
	function index() 
	{
		$this->load->view('admin/foto_albummanter');		
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$foto_album['row'] = $this->Foto_AlbumModel->detalhar($id);
		}
		$this->load->view('admin/foto_albummanter', $foto_album);
	}
	
	function deletar($id) 
	{
		$this->Foto_AlbumModel->deletar($id);
		Foto_Album::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');		
		
		$foto_albumPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/foto_albummanter', $foto_albumPost);
		} else {
			$foto_album = array(
				'nome'	=> $this->input->post('nome'),							
			);
						
			$idfoto_album = $this->input->post('id');
			if($idfoto_album){			
				$this->Foto_AlbumModel->update($idfoto_album, $foto_album);
			} else {						
				$this->Foto_AlbumModel->insert($foto_album);
			} 
			Foto_Album::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/foto_album/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->Foto_AlbumModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->Foto_AlbumModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $foto_album['pag'] = $this->pagination->create_links();
        $foto_album['foto_album'] = $query->result_array();
		
		$this->load->view('admin/foto_albumlistar',$foto_album);
	}
	
}
?>
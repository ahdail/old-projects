<?php
class Album extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session', 'pagination'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/foto_albummodel',"Foto_AlbumModel");
		$this->load->model('admin/foto_imagemmodel',"Foto_ImagemModel");
		
	}
	function index() 
	{	
		Album::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/album/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->Foto_AlbumModel->getTotal(),
    		'uri_segment' 	=> 4,			
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->Foto_AlbumModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $album['pag'] = $this->pagination->create_links();
        $album['album'] = $query->result_array();
		
		$album['comissoes'] = $this->ComissaoModel->comissaoSite();
		$album['apoio'] = $this->ApoioModel->apoioSite();		
		$album['legislacoes'] = $this->LegislacaoModel->legislacao();
		$album['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$this->load->view('album',$album);
	}
	
	function ver($id) 
	{		
		$imagem['nomealbum'] = $this->Foto_AlbumModel->detalhar($id);
		$imagem['imagem'] = $this->Foto_AlbumModel->albummostrar($id);
		
		$imagem['comissoes'] = $this->ComissaoModel->comissaoSite();
		$imagem['apoio'] = $this->ApoioModel->apoioSite();				
		$imagem['legislacoes'] = $this->LegislacaoModel->legislacao();
		$imagem['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$imagem['fotos'] = "fotos";
		$this->load->view('album',$imagem);
	}
	
	
	
}
?>
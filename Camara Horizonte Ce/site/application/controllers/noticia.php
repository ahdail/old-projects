<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'data'));
		$this->load->library(array('session', 'pagination'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/noticiamodel',"NoticiaModel");
	}
	function index() 
	{
	
		Noticia::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/noticia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NoticiaModel->getTotal(),
    		'uri_segment' 	=> 3,
			
    		'first_link' 	=> '«  primeira',
    		'last_link' 	=> 'última »'
    	);
                
        $query = $this->NoticiaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $noticia['pag'] = $this->pagination->create_links();
        $noticia['noticia'] = $query->result_array();
		
		$noticia['comissoes'] = $this->ComissaoModel->comissaoSite();
		$noticia['apoio'] = $this->ApoioModel->apoioSite();		
		$noticia['legislacoes'] = $this->LegislacaoModel->legislacao();
		$noticia['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$this->load->view('noticia',$noticia);
	}
	
	function ver($id=0) 
	{
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['noticia'] = $this->NoticiaModel->detalhar($id);
		$this->load->view('noticia', $var);
	}
}
?>
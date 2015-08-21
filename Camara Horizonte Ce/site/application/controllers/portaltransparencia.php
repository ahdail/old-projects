<?php
class PortalTransparencia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session', 'pagination'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/transparenciamodel',"TransparenciaModel");
	}
	function index() 
	{	
		PortalTransparencia::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/portaltransparencia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->TransparenciaModel->getTotal(),
    		'uri_segment' 	=> 3,
			
    		'first_link' 	=> '«  primeira',
    		'last_link' 	=> 'última »'
    	);
                
        $query = $this->TransparenciaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $portaltransparencia['pag'] = $this->pagination->create_links();
        $portaltransparencia['portaltransparencia'] = $query->result_array();
		
		$portaltransparencia['comissoes'] = $this->ComissaoModel->comissaoSite();
		$portaltransparencia['apoio'] = $this->ApoioModel->apoioSite();		
		$portaltransparencia['legislacoes'] = $this->LegislacaoModel->legislacao();
		$portaltransparencia['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$this->load->view('portaltransparencia',$portaltransparencia);
	}
	
	function ver($id=0) 
	{
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['portaltransparencia'] = $this->TransparenciaModel->detalhar($id);
		$this->load->view('portaltransparencia', $var);
	}
}
?>
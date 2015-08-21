<?php
class Galeria extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/galeriamodel',"GaleriaModel");
	}
	function index() 
	{
		$this->load->view('admin/galerialistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/galeria/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->GaleriaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->GaleriaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $galeria['pag'] = $this->pagination->create_links();
        $galeria['galeria'] = $query->result_array();
		
		
		$this->load->view('admin/galerialistar',$galeria);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$galeria['row'] = $this->GaleriaModel->detalhar($id);
		}
		
		$this->load->view('admin/galeriamanter',$galeria);
	}
	
	function deletar($id) 
	{
		$this->GaleriaModel->deletar($id);
		Galeria::listar();	
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('tipogaleria', 'Tipo de galeria', 'required');
		$this->form_validation->set_rules('nomegaleria', 'Nome da Galeria', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
				
		$galeriaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/galeriamanter', $galeriaPost);
		} else {
			$galeria = array(
				'nomegaleria' 	=> $this->input->post('nomegaleria'),
				'descricao' => $this->input->post('descricao'),	
				'tipogaleria' => $this->input->post('tipogaleria')					
			);

			$idgaleria = $this->input->post('id');
			if($idgaleria){			
				$this->GaleriaModel->update($idgaleria, $galeria);
			} else {			
				$this->GaleriaModel->insert($galeria);
			} 
			Galeria::listar();
		}		
	}
}
?>
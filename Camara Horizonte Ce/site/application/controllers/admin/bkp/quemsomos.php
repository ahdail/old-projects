<?php
class QuemSomos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','funcoes', 'pagination'));
		$this->load->model('admin/quemsomosmodel',"QuemSomosModel");
	}
	function index() 
	{
		$this->load->view('admin/quemsomoslistar');
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$quemsomos['row'] = $this->QuemSomosModel->detalhar($id);
		}
		$this->load->view('admin/quemsomosmanter',$quemsomos);
	}
	
	function deletar($id) 
	{
		$this->QuemSomosModel->deletar($id);
		QuemSomos::listar();		
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
				
		$quemsomosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/quemsomosmanter', $quemsomosPost);
		} else {
			$quemsomos = array(				
				'descricao' => $this->input->post('descricao')			
			);

		
			$idquemsomos = $this->input->post('id');
			if($idquemsomos){
				$this->QuemSomosModel->update($idquemsomos, $quemsomos);
			} else {				
				$this->QuemSomosModel->insert($quemsomos);
			} 
			QuemSomos::listar();
		}		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/quemsomos/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->QuemSomosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->QuemSomosModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $quemsomos['pag'] = $this->pagination->create_links();
        $quemsomos['quemsomos'] = $query->result_array();
		
		
		$this->load->view('admin/quemsomoslistar',$quemsomos);
	}

	
}
?>
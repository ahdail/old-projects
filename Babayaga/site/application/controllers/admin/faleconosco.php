<?php
class FaleConosco extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/faleconoscomodel',"FaleConoscoModel");
	}
	function index() 
	{
		$this->load->view('admin/faleconoscolistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/faleconosco/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->FaleConoscoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->FaleConoscoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $faleconosco['pag'] = $this->pagination->create_links();
        $faleconosco['faleconosco'] = $query->result_array();
		
		
		$this->load->view('admin/faleconoscolistar',$faleconosco);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$faleconosco['row'] = $this->FaleConoscoModel->detalhar($id);
		}
		$this->load->view('admin/faleconoscomanter',$faleconosco);
	}
	
	function deletar($id) 
	{		
		$this->FaleConoscoModel->deletar($id);
		FaleConosco::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('mensagem', 'Mensagem', 'required');
		
		$faleconoscoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/faleconoscomanter', $faleconoscoPost);
		} else {
			$faleconosco = array(
				'nome' 	=> $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'mensagem' => $this->input->post('mensagem')				
			);
			
			$idfaleconosco = $this->input->post('id');
			if($idfaleconosco){				
				$this->FaleConoscoModel->update($idfaleconosco, $faleconosco);
			} else {				
				$this->FaleConoscoModel->insert($faleconosco);
			} 
			FaleConosco::listar();
		}	
	}
}
?>
<?php
class Newsletter extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/newslettermodel',"NewsletterModel");
	}
	function index() 
	{
		$this->load->view('admin/newsletterlistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/newsletter/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NewsletterModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->NewsletterModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $newsletter['pag'] = $this->pagination->create_links();
        $newsletter['newsletter'] = $query->result_array();
		
		
		$this->load->view('admin/newsletterlistar',$newsletter);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$newsletter['row'] = $this->NewsletterModel->detalhar($id);
		}
		$this->load->view('admin/newslettermanter',$newsletter);
	}
	
	function deletar($id) 
	{		
		$this->NewsletterModel->deletar($id);
		Newsletter::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
				
		$newsletterPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/newslettermanter', $newsletterPost);
		} else {
			$newsletter = array(
				'nome' 	=> $this->input->post('nome'),
				'email' => $this->input->post('email')			
			);
			
			$idnewsletter = $this->input->post('id');
			if($idnewsletter){				
				$this->NewsletterModel->update($idnewsletter, $newsletter);
			} else {				
				$this->NewsletterModel->insert($newsletter);
			} 
			Newsletter::listar();
		}	
	}
}
?>
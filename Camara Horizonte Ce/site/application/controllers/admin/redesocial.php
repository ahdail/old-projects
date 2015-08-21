<?php
class RedeSocial extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/redesocialmodel',"RedeSocialModel");
	}
	function index() 
	{
		$this->load->view('admin/redesociallistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/redesocial/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->RedeSocialModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->RedeSocialModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $redesocial['pag'] = $this->pagination->create_links();
        $redesocial['redesocial'] = $query->result_array();
		
		$this->load->view('admin/redesociallistar',$redesocial);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$redesocial['row'] = $this->RedeSocialModel->detalhar($id);
		}
		$this->load->view('admin/redesocialmanter', $redesocial);
	}
	
	function deletar($id) 
	{
		$this->RedeSocialModel->deletar($id);
		RedeSocial::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('link', 'Link', 'required');
						
		$redesocialPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/redesocialmanter', $redesocialPost);
		} else {
			$redesocial = array(
				'link' 	=> $this->input->post('link'),
				'rede' => $this->input->post('redesocial')
			);
						
			$idredesocial = $this->input->post('id');
			if($idredesocial){
			//echo "edit";
			//die();			
				$this->RedeSocialModel->update($idredesocial, $redesocial);
			} else {						
				$this->RedeSocialModel->insert($redesocial);
			} 
			RedeSocial::listar();
		}	
	}
}
?>
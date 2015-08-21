<?php
class Enquete_Pergunta extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/enquete_perguntamodel',"Enquete_PerguntaModel");
	}
	function index() 
	{
		$this->load->view('admin/enquete_perguntalistar');
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$enquete_pergunta['row'] = $this->Enquete_PerguntaModel->detalhar($id);
		}
		$this->load->view('admin/enquete_perguntamanter', $enquete_pergunta);
	}
	
	function deletar($id) 
	{
		$this->Enquete_PerguntaModel->deletar($id);
		Enquete_Pergunta::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('pergunta', 'Pergunta', 'required');		
		
		$enquete_perguntaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/enquete_perguntamanter', $enquete_perguntaPost);
		} else {
			$enquete_pergunta = array(
				'pergunta'	=> $this->input->post('pergunta'),							
			);
						
			$idenquete_pergunta = $this->input->post('id');
			if($idenquete_pergunta){			
				$this->Enquete_PerguntaModel->update($idenquete_pergunta, $enquete_pergunta);
			} else {						
				$this->Enquete_PerguntaModel->insert($enquete_pergunta);
			} 
			Enquete_Pergunta::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/enquete_pergunta/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->Enquete_PerguntaModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->Enquete_PerguntaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $enquete_pergunta['pag'] = $this->pagination->create_links();
        $enquete_pergunta['enquete_pergunta'] = $query->result_array();
		
		$this->load->view('admin/enquete_perguntalistar',$enquete_pergunta);
	}	
	
	
}
?>
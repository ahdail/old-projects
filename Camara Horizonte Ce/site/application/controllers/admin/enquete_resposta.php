<?php
class Enquete_Resposta extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/enquete_respostamodel',"Enquete_RespostaModel");		
	}
	function index() 
	{
		$enquete_resposta['perguntas'] = $this->Enquete_RespostaModel->perguntas();
		$this->load->view('admin/enquete_respostamanter', $enquete_resposta);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$enquete_resposta['row'] = $this->Enquete_RespostaModel->detalhar($id);
		}
		$enquete_resposta['perguntas'] = $this->Enquete_RespostaModel->perguntas();
		
		$this->load->view('admin/enquete_respostamanter', $enquete_resposta);
	}
	
	function deletar($id) 
	{
		$this->Enquete_RespostaModel->deletar($id);
		Enquete_Resposta::listar();
	}
	
	function manter() 
	{		
		$this->form_validation->set_rules('id_pergunta', 'Pergunta', 'required');		
		$this->form_validation->set_rules('resposta1', 'Resposta 1', 'required');
		$this->form_validation->set_rules('resposta2', 'Resposta 2', 'required');
		$this->form_validation->set_rules('resposta3', 'Resposta 3', 'required');
		$this->form_validation->set_rules('resposta4', 'Resposta 4', 'required');
		
		$enquete_respostaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/enquete_respostamanter', $enquete_respostaPost);
		} else {
			$enquete_resposta = array(
				'id_pergunta'	=> $this->input->post('id_pergunta'),
				'resposta1'		=> $this->input->post('resposta1'),
				'resposta2'		=> $this->input->post('resposta2'),	
				'resposta3'		=> $this->input->post('resposta3'),	
				'resposta4'		=> $this->input->post('resposta4')				
			);
						
			$idenquete_resposta = $this->input->post('id');
			if($idenquete_resposta){			
				$this->Enquete_RespostaModel->update($idenquete_resposta, $enquete_resposta);
			} else {						
				$this->Enquete_RespostaModel->insert($enquete_resposta);
			} 
			Enquete_Resposta::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/enquete_resposta/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->Enquete_RespostaModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->Enquete_RespostaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $enquete_resposta['pag'] = $this->pagination->create_links();
        $enquete_resposta['enquete_resposta'] = $query->result_array();
	
		
		$this->load->view('admin/enquete_respostalistar',$enquete_resposta);
	}	
}
?>
<?php
class Faq extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/faqmodel',"FaqModel");
	}
	
	function index()
	{
		Faq::listar();
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/admin/faq/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->FaqModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $query = $this->FaqModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $faq['pag'] = $this->pagination->create_links();
		
        $faq['faq'] = $query->result_array();
        
        $this->load->view('admin/faqlistar', $faq);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
			$faq['row'] = $this->FaqModel->detalhar($id);
		}
		$this->load->view('admin/faqmanter', $faq);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$faq['row'] = $this->FaqModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $faq['row']['titulo'], $faq['row']['id'], "Excluiu [FAQ]");
		$this->auditoria->gravar();
		
		$this->FaqModel->deletar($id);
		faq::listar();
	}
	function manter()
	{
		$this->form_validation->set_rules ('pergunta', 'Pergunta', 'required');
		$this->form_validation->set_rules ('resposta', 'Rergunta', 'required');
		$faq = array(
			'pergunta' => $this->input->post('pergunta'),
			'resposta'   => $this->input->post('resposta')
		);
		
		$faqPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/faqmanter', $faqPost);
		} else {
			$session_login = $this->session->userdata('login');
			$pergunta = $this->input->post('pergunta');
			$id = $this->input->post('id');
			if ($id){// Ediчуo
				$this->FaqModel->update($id,$faq);
				// Grava Log
				$this->auditoria->carregar($session_login, $pergunta, $id, "Editou [FAQ]");
				$this->auditoria->gravar();
			} else {// Adiчуo
				$this->FaqModel->insert($faq);
				// Grava Log
				$this->auditoria->carregar($session_login, $titulo, $id, "Adicionou [FAQ]");
				$this->auditoria->gravar();
			}	
			$this->listar();		
		}
	}
}
?>
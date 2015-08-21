<?php
class Colecao extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/colecaomodel',"ColecaoModel");
	}
	function index() 
	{
		$this->load->view('admin/colecaolistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/colecao/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ColecaoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ColecaoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $colecao['pag'] = $this->pagination->create_links();
        $colecao['colecao'] = $query->result_array();
		
		
		$this->load->view('admin/colecaolistar',$colecao);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$colecao['row'] = $this->ColecaoModel->detalhar($id);
		}
		$this->load->view('admin/colecaomanter',$colecao);
	}
	
	function deletar($id) 
	{
		// Grava o Log 
		//$new['row'] = $this->NewsletterModel->detalhar($id);
		//$session_login = $this->session->userdata('login');
		//$this->auditoria->carregar($session_login, $new['row']['email'], $new['row']['id'], "Excluiu [Email da NEWSLETTER]");
		//$this->auditoria->gravar();
		
		$this->ColecaoModel->deletar($id);
		Colecao::listar();
	
		
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nomecolecao', 'Nome da Coleção', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		
		
		$colecaoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/colecaomanter', $colecaoPost);
		} else {
			$colecao = array(
				'nomecolecao' 	=> $this->input->post('nomecolecao'),
				'descricao' => $this->input->post('descricao'),			
			);

			$session_login = $this->session->userdata('login');
			$email = $this->input->post('email');
			$idcolecao = $this->input->post('id');
			if($idcolecao){
				// Grava Log
				//$this->auditoria->carregar($session_login, $email, $idcolecao, "Editou [COLEÇÃO]");
				//$this->auditoria->gravar();
				$this->ColecaoModel->update($idcolecao, $colecao);
			} else {
				// Grava Log
				//$this->auditoria->carregar($session_login, $email, $idQuemSomos, "Adicionou [COLEÇÃO]");
				//$this->auditoria->gravar();
				
				$this->ColecaoModel->insert($colecao);
			} 
			Colecao::listar();
		}		
	}
}
?>
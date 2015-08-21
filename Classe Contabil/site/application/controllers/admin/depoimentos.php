<?php
class Depoimentos extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/depoimentosmodel',"DepoimentosModel");
	}
	
	function index()
	{
		Depoimentos::listar();
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/admin/depoimentos/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->DepoimentosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $query = $this->DepoimentosModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $depoimentos['pag'] = $this->pagination->create_links();
		
        $depoimentos['depoimentos'] = $query->result_array();
        
        $this->load->view('admin/depoimentoslistar', $depoimentos);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
			$depoimentos['row'] = $this->DepoimentosModel->detalhar($id);
		}
		$this->load->view('admin/depoimentosmanter', $depoimentos);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$depoimentos['row'] = $this->DepoimentosModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $depoimentos['row']['titulo'], $depoimentos['row']['id'], "Excluiu [DEPOIMENTO]");
		$this->auditoria->gravar();
		
		$this->DepoimentosModel->deletar($id);
		Depoimentos::listar();
	}
	function manter()
	{
		$this->form_validation->set_rules ('nome', 'Nome', 'required');
		$this->form_validation->set_rules ('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules ('depoimento', 'Depoimento', 'required');
		
		$depoimentos = array(
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'depoimento'   => $this->input->post('depoimento'),
			'autorizado'   => $this->input->post('aut')
		);
		
		$depoimentosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/depoimentosmanter', $depoimentosPost);
		} else {
			$session_login = $this->session->userdata('login');
			$nome = $this->input->post('nome');
			$id = $this->input->post('id');
			if ($id){// Ediчуo
				$this->DepoimentosModel->update($id, $depoimentos);
				// Grava Log
				$this->auditoria->carregar($session_login, $nome, $id, "Editou [DEPOIMENTO]");
				$this->auditoria->gravar();
			} else {// Adiчуo
				$this->DepoimentosModel->insert($depoimentos);
				// Grava Log
				$this->auditoria->carregar($session_login, $nome, $id, "Adicionou [DEPOIMENTO]");
				$this->auditoria->gravar();
			}	
			$this->listar();		
		}
	}
	
	function depoimentoListarFiltro($status)
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/depoimentos/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->DepoimentosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $this->pagination->initialize($config);
        
        
		if ($status == 1) {
			// Retorna aguardando autorizaчуo.
			$query = $this->DepoimentosModel->exibirAguardandoAutorizacao($start, $config['per_page']);
		}
		
		if ($status == 2) {
			//Autorizado
			$query = $this->DepoimentosModel->exibirAutorizado($start, $config['per_page']);
		}
		
		if ($status == 3) {
			//Nуo autorizado
			$query = $this->DepoimentosModel->exibirNaoAutorizado($start, $config['per_page']);
		}
		
		$this->pagination->initialize($config);
        $depoimentos['pag'] = $this->pagination->create_links();
        $depoimentos['status'] = $status;
        $depoimentos['depoimentos'] = $query->result_array();
        $this->load->view('admin/depoimentoslistar', $depoimentos);
	}
}
?>
<?php
class JuizoDiario extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation','session', 'funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/juizodiariomodel',"JuizoDiarioModel");
	}
	function index() 
	{
		JuizoDiario::listar();
	}
	 
	function listar($start = 0) 
	{
    	
    	$config = array(
    		'base_url' 		=> site_url('/admin/juizodiario/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->JuizoDiarioModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
                
        $query = $this->JuizoDiarioModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $juizodiario['pag'] = $this->pagination->create_links();
		
        $juizodiario['juizodiario'] = $query->result_array();
		$this->load->view('admin/juizodiariolistar', $juizodiario);
	}
	function detalhar($id = 0)
	{
	    $juizodiario['row'] = $this->JuizoDiarioModel->detalhar($id);
		$this->load->view('admin/juizodiariomanter',$juizodiario);
	}
	
	function deletar($id)
	{
		// Log
		$juizodiario['row'] = $this->JuizoDiarioModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $juizodiario['row']['pergunta'], $juizodiario['row']['id'], "Excluiu m");
		$this->auditoria->gravar();
		
		$this->JuizoDiarioModel->deletar($id);
		JuizoDiario::listar();
	}
	
	function manter()
	{	
		$this->form_validation->set_rules('pergunta', 'Pergunta', 'required');
		$this->form_validation->set_rules('resposta', 'Resposta', 'required');
		
		// Traz todos os dados do form para Ediзгo
		$juizoDiarioPost['row'] = $_POST;
		$juizodiario = array(
			'pergunta' => nl2br($this->input->post('pergunta')),
			'resposta' => nl2br($this->input->post('resposta')),
		);
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/juizodiariomanter',$juizoDiarioPost);
		} else {
			$session_login = $this->session->userdata('login');
			$pergunta = $this->input->post('pergunta');
			$idJuizoDiario = $this->input->post('id');
			if($this->input->post('id')){
				// Grava Log
				$this->auditoria->carregar($session_login, $pergunta, $idJuizoDiario, "Editou [JUНZO DIБRIO]");
				$this->auditoria->gravar();
		
				$this->JuizoDiarioModel->update($this->input->post('id'),$juizodiario);
			} else {
				// Grava Log
				$this->auditoria->carregar($session_login, $pergunta, $idJuizoDiario, "Adicionou [JUНZO DIБRIO]");
				$this->auditoria->gravar();
				
				$this->JuizoDiarioModel->insert($juizodiario);
			} 
			JuizoDiario::listar();
		}		
	}
}
?>
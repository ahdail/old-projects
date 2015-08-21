<?php
class Secao extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date'));
		$this->load->library(array ('form_validation', 'session', 'pagination') );
		$this->load->model('admin/secaomodel',"SecaoModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index()
	{
		Secao::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/admin/secao/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->SecaoModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
    	
    	$query = $this->SecaoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $secao['pag'] = $this->pagination->create_links();
        $secao['secao'] = $query->result_array();
        $this->load->view('admin/secaolistar',$secao);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
	       	$secao['row'] = $this->SecaoModel->detalhar($id);
		} 
		$this->load->view('admin/secaomanter',$secao);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [SEÇÃO] Deletou Seção do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->SecaoModel->deletar($id);
		Secao::listar();
	}
	
	function manter()
	{

		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('codigo', 'Código', 'required');
		
		// Edição
		$secaoPost['row'] = $_POST;
		
		// Carregar os dados passado através do formulário
		$secao = array(
			'nome' => $this->input->post('nome'),
			'codigo' => $this->input->post('codigo')
		);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/secaomanter',$secaoPost);
		} else {
			$session_login = $this->session->userdata('login');
			$nomeSecao = $this->input->post('nome');
			$idSecao = $this->input->post('id');
			if($idSecao){
				// Grava o Log 
				$log = "($session_login) [SEÇÃO] Alterou Seção($nomeSecao) do id ($idSecao)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->SecaoModel->update($_POST['id'],$secao);
			} else {
				// Grava o Log 
				$log = "($session_login) [SEÇÃO] Adicionou Seção do nome ($nomeSecao)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->SecaoModel->insert($secao);
			} 
			Secao::listar();
		}
	}
}
?>
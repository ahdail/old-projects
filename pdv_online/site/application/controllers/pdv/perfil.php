<?php
class Perfil extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library (array ('form_validation', 'session', 'pagination'));
		
		$this->load->model('pdv/perfilmodel',"PerfilModel");
		//$this->load->model('pdv/auditoriamodel',"AuditoriaModel");
		$this->load->model('pdv/perfilmodel',"SecaoModel");
	}
	
	function index()
	{
		Perfil::listar();		
	}
	
	function listar($start = 0) {
	
		$config = array(
    		'base_url' => site_url('/pdv/perfil/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->PerfilModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'кltima'
    	);
    	$query = $this->PerfilModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	$perfil['pag'] = $this->pagination->create_links();
		
        $perfil['perfil'] = $query->result_array();
        $this->load->view('pdv/perfillistar',$perfil);
	}
	
	function detalhar($id)
	{	
		if ($id) {
	       	$perfil['row'] = $this->PerfilModel->detalhar($id);
		} 
		$this->load->view('pdv/perfilmanter',$perfil);	
	}
	
	function deletar($id)
	{
		//$session_login = $this->session->userdata('login');
		//$log = "($session_login) [PERFIL] Deletou Perfil do id ($id)"; 
		//$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		//$this->AuditoriaModel->insert($auditoria);
		$this->PerfilModel->deletar($id);
		Perfil::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('perfil', 'Perfil', 'required');
		$this->form_validation->set_rules('sigla', 'Sigla', 'required');
		
		// Ediчуo
		$perfilPost['row'] = $_POST;
		
		// Carregar os dados passado atravщs do formulсrio
		
		$perfil = array(
			'perfil' => $this->input->post('perfil'),
			'sigla' => $this->input->post('sigla')
		);
		
		if ($this->form_validation->run() == FALSE){					
			$this->load->view('pdv/perfilmanter', $perfilPost);
		} else {
			// Ediчуo
			$session_login = $this->session->userdata('login');
			$nomePerfil = $this->input->post('nome');
			$idPerfil = $this->input->post('id');
			if($idPerfil){
				// Grava o Log 
				$log = "($session_login) [PERFIL] Alterou Perfil do nome ($nomePerfil) do id ($idPerfil)";  
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				//$this->AuditoriaModel->insert($auditoria);
				$this->PerfilModel->update($_POST['id'], $perfil);
			} else {
				// Adiчуo
				// Grava o Log 
				//$log = "($session_login) [PERFIL] Adicionou Perfil do nome ($nomePerfil)";  
				//$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				//$this->AuditoriaModel->insert($auditoria);
				$this->PerfilModel->insert($perfil);
			} 
			Perfil::listar();
		}
	}
}
?>
<?php
class Perfil extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');	
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/perfilmodel',"PerfilModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
		$this->load->model('admin/perfilmodel',"SecaoModel");
	}
	
	function index()
	{
		Perfil::listar();		
	}
	
	function listar($start = 0) {
	
		$config = array(
    		'base_url' => site_url('/admin/perfil/listar/'),
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
        $this->load->view('admin/perfillistar',$perfil);
	}
	
	function detalhar($id)
	{
		if ($id == 0) {
			$perfil['not'] = $this->PerfilModel->exibirPerfilNotIn($id);
		} else {
			$perfil['join'] = $this->PerfilModel->exibirPerfil($id);
			$perfil['not'] = $this->PerfilModel->exibirPerfilNotIn($id);
			$perfil['permissao'] = $this->PerfilModel->exibirSecao();
			$perfil['row'] = $this->PerfilModel->detalhar($id);
		}
		//Rendeniza a view. Parтmetro(opcional) transporta variсveis do controller para o view
		$this->load->view('admin/perfilmanter',$perfil);
	}
	
	function deletar($id)
	{
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [PERFIL] Deletou Perfil do id ($id)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->PerfilModel->deletar($id);
		Perfil::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('idSecao2', 'Seчуo', 'required');
		
		// Ediчуo
		$secaoPost['row'] = $_POST;
		
		// Carregar os dados passado atravщs do formulсrio
		$indice = $this->input->post('idSecao2');
		$perfil = array('nome' => $this->input->post('nome'));
		
		if ($this->form_validation->run() == FALSE){
			
			$secaoPost['not'] = $this->PerfilModel->exibirSecao();
			$this->load->view('admin/perfilmanter',$secaoPost);
		} else {
			// Ediчуo
			$session_login = $this->session->userdata('login');
			$nomePerfil = $this->input->post('nome');
			$idPerfil = $this->input->post('id');
			if($idPerfil){
				// Grava o Log 
				$log = "($session_login) [PERFIL] Alterou Perfil do nome ($nomePerfil) do id ($idPerfil)";  
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->PerfilModel->insertEdicao($perfil,$indice,$_POST['id']);
			} else {
				// Adiчуo
				// Grava o Log 
				$log = "($session_login) [PERFIL] Adicionou Perfil do nome ($nomePerfil)";  
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->PerfilModel->insert($perfil,$indice);
			} 
			Perfil::listar();
		}
	}
}
?>
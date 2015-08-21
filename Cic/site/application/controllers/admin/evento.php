<?php
class Evento extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
		$this->load->model('admin/eventoModel',"EventoModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index()
	{
		Evento::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/evento/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->EventoModel->getTotal(),
    		'uri_segment'	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
    	
    	$query = $this->EventoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $evento['pag'] = $this->pagination->create_links();
        $evento['evento'] = $query->result_array();
        $this->load->view('admin/eventolistar',$evento);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$evento['row'] = $this->EventoModel->detalhar($id);
	       	$data = $this->EventoModel->exibirData($id);
	    	$evento['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$this->load->view('admin/eventomanter', $evento);
	}
	
	function deletar($id)
	{
		// Log
		$evento['row'] = $this->EventoModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $evento['row']['titulo'], $evento['row']['id'], "Excluiu [EVENTO]");
		$this->auditoria->gravar();
		
		$this->EventoModel->deletar($id);
		Evento::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		//$this->form_validation->set_rules('descricao', 'Descriчуo', 'required');
		
		$eventoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/eventomanter',$eventoPost);
		} else {
			$data = $this->input->post('data');
			$data_nova = $this->funcoes->converte_data($data);
			$evento = array(
				'titulo' => $this->input->post('titulo'),
				'data' => $data_nova,
				'descricao' => $this->input->post('descricao')
			);
			// Parтmetros utilizados na gravaчуo do Log
			$session_login = $this->session->userdata('login');
			$tituloEvento = $this->input->post('titulo');
			$idEvento = $this->input->post('id');
			if($idEvento){
				$this->EventoModel->update($idEvento, $evento);
				// Grava Log
				$this->auditoria->carregar($session_login, $tituloEvento, $idEvento, "Editou [EVENTO]");
				$this->auditoria->gravar();
			} else {
				$this->EventoModel->insert($evento);
				// Grava Log
				$this->auditoria->carregar($session_login, $tituloEvento, $idEvento, "Adicionou [EVENTO]");
				$this->auditoria->gravar();
			} 
			Evento::listar();
		}
	}
}
?>
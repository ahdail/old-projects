<?php
class novaPagina extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
		//$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}

	function index()
	{
		novaPagina::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/novapagina/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NovaPaginaModel->getTotal(),
    		'uri_segment'	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
    	
    	$query = $this->NovaPaginaModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $novapagina['pag'] = $this->pagination->create_links();
        $novapagina['novapagina'] = $query->result_array();
        $this->load->view('admin/novapaginalistar',$novapagina);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
	       	$novapagina['row'] = $this->NovaPaginaModel->detalhar($id);
		} 
		$this->load->view('admin/novapaginamanter', $novapagina);
	}
	
	function deletar($id)
	{
		// Log
		$novapagina['row'] = $this->NovaPaginaModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $novapagina['row']['titulo'], $novapagina['row']['id'], "Excluiu [PÁGINA]");
		$this->auditoria->gravar();
		
		$this->NovaPaginaModel->deletar($id);
		novaPagina::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('menu', 'Menu', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		$novapaginaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/novapaginamanter',$novapaginaPost);
		} else {
			$data = $this->input->post('data');
			$data_nova = $this->funcoes->converte_data($data);
			$novapagina = array(
				'menu' 		=> $this->input->post('menu'),
				'titulo' 	=> $this->input->post('titulo'),
				'conteudo' 	=> $this->input->post('conteudo')
			);
			// Parâmetros utilizados na gravação do Log
			$session_login = $this->session->userdata('login');
			$tituloPagina = $this->input->post('titulo');
			$idPagina = $this->input->post('id');
			if($idPagina){
				$this->NovaPaginaModel->update($idPagina, $novapagina);
				// Grava Log
				$this->auditoria->carregar($session_login, $tituloPagina, $idPagina, "Editou [PÁGINA]");
				$this->auditoria->gravar();
			} else {
				$this->NovaPaginaModel->insert($novapagina);
				// Grava Log
				$this->auditoria->carregar($session_login, $tituloPagina, $idPagina, "Adicionou [PÁGINA]");
				$this->auditoria->gravar();
			} 
			novaPagina::listar();
		}
	}
}
?>
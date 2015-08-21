<?php
class Conteudo extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/conteudomodel',"ConteudoModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		Conteudo::listar();
	}
	 
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/conteudo/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ConteudoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ConteudoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $conteudo['pag'] = $this->pagination->create_links();
        $conteudo['conteudo'] = $query->result_array();
		$this->load->view('admin/conteudolistar',$conteudo);
	}
	
	function detalhar($id=0)
	{
		if ($id) {
	    	$conteudo['row'] = $this->ConteudoModel->detalhar($id);
	    	$data = $this->ConteudoModel->exibirData($id);
	    	$conteudo['row']['data'] = $this->funcoes->converte_data($data['data']);
		}
		$this->load->view('admin/conteudomanter',$conteudo);
	}
	
	function deletar($id)
	{
		// Log
		$conteudo['row'] = $this->ConteudoModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $conteudo['row']['titulo'], $conteudo['row']['id'], "Excluiu [CONTEÚDO]");
		$this->auditoria->gravar();
		
		$this->ConteudoModel->deletar($id);
		Conteudo::listar();
	}
	
	function manter()
	{	
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('exibir', 'Opção para exibicão', 'required');
		
		$conteudoPost['row'] = $_POST;
		
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/conteudomanter', $conteudoPost);
		} else {
			$conteudo = array(
				'titulo' 	=> $this->input->post('titulo'),
				'data' 		=> $data_nova,
				'resumo' 	=> $this->input->post('resumo'),
				'conteudo' 	=> $this->input->post('conteudo'),
				'exibir' 	=> $this->input->post('exibir'),
				'fonte' 	=> $this->input->post('fonte'),
				'siteFonte' => $this->input->post('siteFonte')
			);
			$session_login = $this->session->userdata('login');
			$email = $this->input->post('email');
			$idConteudo = $this->input->post('id');
			if($idConteudo){
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idConteudo, "Editou [CONTEÚDO]");
				$this->auditoria->gravar();
				
				$this->ConteudoModel->update($idConteudo, $conteudo);
			} else {
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idConteudo, "Adicionou [CONTEÚDO]");
				$this->auditoria->gravar();
				
				$this->ConteudoModel->insert($conteudo);
			} 
			Conteudo::listar();
		}		
	}
}
?>
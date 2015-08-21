<?php
class Evento extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
		$this->load->model('admin/eventoModel',"EventoModel");
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
    		'last_link' 	=> 'Última'
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
		//$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		echo  $this->input->post('email');
		
		$eventoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/eventomanter',$eventoPost);
		} else {
			$data = $this->input->post('data');
			$data_nova = $this->funcoes->converte_data($data);
			$evento = array(
				'titulo' 		=> $this->input->post('titulo'),
				'data' 			=> $data_nova,
				'local' 		=> $this->input->post('local'),
				'email' 		=> $this->input->post('email'),
				'descricao' 	=> $this->input->post('descricao'),
				'autorizado' 	=> $this->input->post('aut')
			);
			// Parâmetros utilizados na gravação do Log
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
			
			if ($this->input->post('email') && $this->input->post('aut') == "S"){
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Evento Autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu evento foi autorizado e está disposnivel no site.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 	
			} else if ($this->input->post('email') && $this->input->post('aut') == "N"){
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Evento não autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu evento não foi autorizado.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 
			}
			
			Evento::listar();
		}
	}
}
?>
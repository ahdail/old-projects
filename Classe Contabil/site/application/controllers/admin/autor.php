<?php
class Autor extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	function index()
	{
		Autor::listar();
	}
	
	function listar($start = 0) 
	{
		// Faz o select
        $config = array(
    		'base_url' 		=> site_url('/admin/autor/listar/'),
    		'per_page'	 	=> 20,
    		'total_rows' 	=> $this->AutorModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
                
        $query = $this->AutorModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $autor['pag'] = $this->pagination->create_links();
		
        $autor['autor'] = $query->result_array();
        $this->load->view('admin/autorlistar',$autor);
	}
	
	function detalhar($id)
	{
		if ($id) {
			$autor['row'] = $this->AutorModel->detalhar($id);
		}
		$this->load->view('admin/autormanter',$autor);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [AUTOR] Deletou Autor do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->AutorModel->deletar($id);
		
		Autor::listar();
	}
	
	function manter()
	{
		$this->load->model('admin/autormodel',"AutorModel");

		// Realiza a validaзгo dos campos do Form
		$this->form_validation->set_rules ( 'nome', 'Nome', 'required' );
		$this->form_validation->set_rules ( 'curriculoResumido', 'Currнculo Resumido', 'required' );
		$this->form_validation->set_rules ( 'email', 'Email', 'required|valid_email' );
		
		// Carregar os dados passado atravйs do formulбrio
		$autor = array(
			'nome' => $this->input->post('nome'),
			'curriculoResumido' => $this->input->post('curriculoResumido'),
			'email' => $this->input->post('email'),
			'ddd' => $this->input->post('ddd'),
			'telefone' => $this->input->post('telefone'),
		);
		
		// Carrega todos os dados num array para serem editados
		$autorPost['row'] = $_POST;
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/autormanter',$autorPost);
		} else {
			// Ediзгo
			$session_login = $this->session->userdata('login');
			$nomeAutor = $this->input->post('nome');
			$idAutor = $this->input->post('id');
			if($idAutor){
				// Grava o Log 
				$log = "($session_login) [AUTOR] Alterou Autor($nomeAutor) do id ($idAutor)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->AutorModel->update($this->input->post('id'),$autor);
			// Adiзгo
			} else {
				// Grava o Log 
				$log = "($session_login) [AUTOR] Adicionou Autor do nome ($nomeAutor)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->AutorModel->insert($autor);
			} 
			Autor::listar();
		}
	}
}
?>
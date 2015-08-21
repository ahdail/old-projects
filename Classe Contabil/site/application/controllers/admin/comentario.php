<?php
class Comentario extends Controller {

	// � necessario executar o controlador da classe Controller.
	function __construct()
	{
		// Executa a fun��o construtora da classe Controller
		parent::Controller();	
		
		// Carregar aos Helpers de Form, URL e DATE e as Library de valida��o
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/comentariomodel',"ComentarioModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	// A a��o index � iniciada quando nenhuma a��o for passada na URL
	function index()
	{
		Comentario::listar();
	}
	
	function opcao($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner ser� atualizado, com o valor preenchido da vari�vel $tipo
		$session_login = $this->session->userdata('login');
			$autorizado = array ('autorizado' => $tipo );
			$log = "($session_login) [COMENTARIO] Alterou o  coment�rio autoriza��o para ($autorizado) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->ComentarioModel->opcao($id, $autorizado);
		Comentario::listar();
	}
	
	function listar($start = 0) 
	{
		// Faz o select
        $config = array(
    		'base_url' => site_url('/admin/comentario/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->ComentarioModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => '�ltima'
    	);
                
        $query = $this->ComentarioModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para pagina��o
        $comentario['pag'] = $this->pagination->create_links();
		
        $comentario['comentario'] = $query->result_array();
        $this->load->view('admin/comentariolistar',$comentario);
	}
	
	function detalhar($id)
	{
		if ($id) {
			// Faz o select
			$comentario['row'] = $this->ComentarioModel->detalhar($id);
		}
		$this->load->view('admin/comentariomanter',$comentario);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [AUTOR] Deletou Comentario do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ComentarioModel->deletar($id);
		
		Comentario::listar();
	}
	
	function manter()
	{

		// Realiza a valida��o dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Coment�rio', 'required' );
		
		// Carregar os dados passado atrav�s do formul�rio
		$comentario = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		// Carrega todos os dados num array para serem editados
		$comentarioPost['row'] = $_POST;
		
		// Ap�s a valida��o dos campos, e dependendo do resultado, � feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/comentarioManter',$comentarioPost);
		} else {
			// Edi��o
			$session_login = $this->session->userdata('login');
			$nomeComentario = $this->input->post('comentario');
			$idComentario = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENT�RIO] Alterou Coment�rio($nomeComentario) do id ($idComentario)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->ComentarioModel->update($idComentario,$comentario);
			// Adi��o
			Comentario::listar();
		}
	}
}
?>
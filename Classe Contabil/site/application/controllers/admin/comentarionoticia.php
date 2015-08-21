<?php
class ComentarioNoticia extends Controller {

	// � necessario executar o controlador da classe Controller.
	function __construct()
	{
		// Executa a fun��o construtora da classe Controller
		parent::Controller();	
		
		// Carregar aos Helpers de Form, URL e DATE e as Library de valida��o
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/comentarionoticiamodel',"ComentarioNoticiaModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	// A a��o index � iniciada quando nenhuma a��o for passada na URL
	function index()
	{
		ComentarioNoticia::listar();
	}
	
	function opcao($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner ser� atualizado, com o valor preenchido da vari�vel $tipo
		$session_login = $this->session->userdata('login');
			$autorizado = array ('autorizado' => $tipo );
			$log = "($session_login) [COMENTARIO NOT�CIA] Alterou o  coment�rio not�cia autoriza��o para ($autorizado) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->ComentarioNoticiaModel->opcao($id, $autorizado);
		ComentarioNoticia::listar();
	}
	
	function listar($start = 0) 
	{
		// Faz o select
        $config = array(
    		'base_url' => site_url('/admin/comentarionoticia/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->ComentarioNoticiaModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => '�ltima'
    	);
                
        $query = $this->ComentarioNoticiaModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para pagina��o
        $comentarioNoticia['pag'] = $this->pagination->create_links();
		
        $comentarioNoticia['comentarioNoticia'] = $query->result_array();
        $this->load->view('admin/comentarionoticialistar',$comentarioNoticia);
	}
	
	function detalhar($id)
	{
		if ($id) {
			// Faz o select
			$comentarioNoticia['row'] = $this->ComentarioNoticiaModel->detalhar($id);
		}
		$this->load->view('admin/comentarionoticiamanter',$comentarioNoticia);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [COMENT�RIO NOT�CIA] Deletou Comentario Not�cia do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ComentarioNoticiaModel->deletar($id);
		
		ComentarioNoticia::listar();
	}
	
	function manter()
	{

		// Realiza a valida��o dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Coment�rio', 'required' );
		
		// Carregar os dados passado atrav�s do formul�rio
		$comentarioNoticia = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		// Carrega todos os dados num array para serem editados
		$comentarioNoticiaPost['row'] = $_POST;
		
		// Ap�s a valida��o dos campos, e dependendo do resultado, � feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/comentarioNoticiaManter',$comentarioPost);
		} else {
			// Edi��o
			$session_login = $this->session->userdata('login');
			$nomeComentarioNoticia = $this->input->post('comentario');
			$idComentarioNoticia = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENT�RIO NOT�CIA] Alterou Coment�rio not�cia ($nomeComentarioNoticia) do id ($idComentarioNoticia)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->ComentarioNoticiaModel->update($idComentarioNoticia,$comentarioNoticia);
			// Adi��o
			ComentarioNoticia::listar();
		}
	}
}
?>
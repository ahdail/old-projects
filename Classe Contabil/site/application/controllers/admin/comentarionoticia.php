<?php
class ComentarioNoticia extends Controller {

	// Й necessario executar o controlador da classe Controller.
	function __construct()
	{
		// Executa a funзгo construtora da classe Controller
		parent::Controller();	
		
		// Carregar aos Helpers de Form, URL e DATE e as Library de validaзгo
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/comentarionoticiamodel',"ComentarioNoticiaModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	// A aзгo index й iniciada quando nenhuma aзгo for passada na URL
	function index()
	{
		ComentarioNoticia::listar();
	}
	
	function opcao($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner serб atualizado, com o valor preenchido da variбvel $tipo
		$session_login = $this->session->userdata('login');
			$autorizado = array ('autorizado' => $tipo );
			$log = "($session_login) [COMENTARIO NOTНCIA] Alterou o  comentбrio notнcia autorizaзгo para ($autorizado) do id ($id)";
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
    		'last_link' => 'Ъltima'
    	);
                
        $query = $this->ComentarioNoticiaModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginaзгo
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
		$log = "($session_login) [COMENTБRIO NOTНCIA] Deletou Comentario Notнcia do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ComentarioNoticiaModel->deletar($id);
		
		ComentarioNoticia::listar();
	}
	
	function manter()
	{

		// Realiza a validaзгo dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Comentбrio', 'required' );
		
		// Carregar os dados passado atravйs do formulбrio
		$comentarioNoticia = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		// Carrega todos os dados num array para serem editados
		$comentarioNoticiaPost['row'] = $_POST;
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/comentarioNoticiaManter',$comentarioPost);
		} else {
			// Ediзгo
			$session_login = $this->session->userdata('login');
			$nomeComentarioNoticia = $this->input->post('comentario');
			$idComentarioNoticia = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENTБRIO NOTНCIA] Alterou Comentбrio notнcia ($nomeComentarioNoticia) do id ($idComentarioNoticia)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->ComentarioNoticiaModel->update($idComentarioNoticia,$comentarioNoticia);
			// Adiзгo
			ComentarioNoticia::listar();
		}
	}
}
?>
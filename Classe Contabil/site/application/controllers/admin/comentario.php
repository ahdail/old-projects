<?php
class Comentario extends Controller {

	// Й necessario executar o controlador da classe Controller.
	function __construct()
	{
		// Executa a funзгo construtora da classe Controller
		parent::Controller();	
		
		// Carregar aos Helpers de Form, URL e DATE e as Library de validaзгo
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		$this->load->model('admin/comentariomodel',"ComentarioModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	// A aзгo index й iniciada quando nenhuma aзгo for passada na URL
	function index()
	{
		Comentario::listar();
	}
	
	function opcao($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner serб atualizado, com o valor preenchido da variбvel $tipo
		$session_login = $this->session->userdata('login');
			$autorizado = array ('autorizado' => $tipo );
			$log = "($session_login) [COMENTARIO] Alterou o  comentбrio autorizaзгo para ($autorizado) do id ($id)";
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
    		'last_link' => 'Ъltima'
    	);
                
        $query = $this->ComentarioModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginaзгo
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

		// Realiza a validaзгo dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Comentбrio', 'required' );
		
		// Carregar os dados passado atravйs do formulбrio
		$comentario = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		// Carrega todos os dados num array para serem editados
		$comentarioPost['row'] = $_POST;
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/comentarioManter',$comentarioPost);
		} else {
			// Ediзгo
			$session_login = $this->session->userdata('login');
			$nomeComentario = $this->input->post('comentario');
			$idComentario = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENTБRIO] Alterou Comentбrio($nomeComentario) do id ($idComentario)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->ComentarioModel->update($idComentario,$comentario);
			// Adiзгo
			Comentario::listar();
		}
	}
}
?>
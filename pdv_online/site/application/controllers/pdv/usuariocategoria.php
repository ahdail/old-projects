<?php
class UsuarioCategoria extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url','date','moeda', 'login'));
		$this->load->library(array ('form_validation', 'session', 'pagination') );
		$this->load->model('pdv/usuariocategoriamodel',"UsuarioCategoriaModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		$this->load->view('pdv/usuariocategoriamanter');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/pdv/usuariocategoria/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->UsuarioCategoriaModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Ъltima'
    	);
    	
    	$query = $this->UsuarioCategoriaModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $usuariocategoria['pag'] = $this->pagination->create_links();
        $usuariocategoria['usuariocategoria'] = $query->result_array();
        $this->load->view('pdv/usuariocategorialistar', $usuariocategoria);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$usuariocategoria['row'] = $this->UsuarioCategoriaModel->detalhar($id);
		} 
		$this->load->view('pdv/usuariocategoriamanter',$usuariocategoria);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [CATEGORIAUSUARIO] Deletou Categoria do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->UsuarioCategoriaModel->deletar($id);
		UsuarioCategoria::listar();
	}
	
	function manter()
	{
		// Realiza a validaзгo dos compos do Form
		$this->form_validation->set_rules('nomecategoria', 'Nome da Categoria', 'required');
		$this->form_validation->set_rules('valor', 'Valor (R$)', 'required');
		
		// Ediзгo
		$usuariocategoriaPost['row'] = $_POST;
		
		// Carregar os dados passado atravйs do formulбrio
		$usuariocategoria = array(
			'nomecategoria' => $this->input->post('nomecategoria'),
			'valor' => $this->input->post('valor')
		);
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('pdv/usuariocategoriamanter',$usuariocategoriaPost);
		} else {
			$session_login = $this->session->userdata('login');
			$nomeCategoria = $this->input->post('nomecategoria');
			$idCategoria = $this->input->post('id');
			if($idCategoria){
				// Edit e Grava o Log 
				$log = "($session_login) [CATEGORIAUSUARIO] Alterou Categoria($nomeCategoria) do id ($idCategoria)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->UsuarioCategoriaModel->update($_POST['id'],$usuariocategoria);
			} else {
				// Add e Grava o Log 
				$log = "($session_login) [CATEGORIAUSUARIO] Adicionou Categoria do nome ($nomeCategoria)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->UsuarioCategoriaModel->insert($usuariocategoria);
			} 
			
			UsuarioCategoria::listar();
		}
	
	}
}
?>
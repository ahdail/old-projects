<?php
class Tag extends Controller {

	// Й necessario executar o controlador da classe Controller.
	function __construct()
	{
		// Executa a funcao construtora da classe Controller
		parent::Controller();	
		
		// Carregar aos Helpers de Form, URL e DATE e as Library de validaзгo
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination'));
		
		// Models
		$this->load->model('admin/tagmodel',"TagModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	function index()
	{
		Tag::listar(0,"");		
	}
	
	// A aзгo index й iniciada quando nenhuma aзгo for passada na URL
	function listar($start = 0,$tagCadastrada) 
	{
		$config = array(
    		'base_url' => site_url('/admin/tag/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->TagModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Ъltima'
    	);
    	
    	$query = $this->TagModel->exibir($start, $config['per_page']);
		$this->pagination->initialize($config);
		$tag['pag'] = $this->pagination->create_links();
		//faz o select
		$tag['tag'] = $query->result_array();
		$tag['tagCadastrada'] = $tagCadastrada;
        $this->load->view('admin/taglistar',$tag);
	}
	
	function detalhar($id)
	{
		if ($id > 0) {
			//Instancia a classe.
			//faz o select
	       	$tag['row'] = $this->TagModel->detalhar($id);
		} 
		$this->load->view('admin/tagmanter',$tag);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [TAG] Deletou Tag do id ($id)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->TagModel->deletar($id);
		Tag::listar(0,0);
	}
	
	function manter()
	{
		// Realiza a validaзгo dos compos do Form
		$this->form_validation->set_rules ('tag', 'Tag', 'required');
		
		// Carregar os dados passado atravйs do formulбrio
		$tag['tag'] = strtoupper($this->input->post('tag'));
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$tagPost['row'] = $_POST;
			$this->load->view('admin/tagmanter',$tagPost);
		} else {
			$nomeTag = strtoupper($this->input->post('tag'));
			$idTag = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			$num_row = $this->TagModel->verificaTagCadastrada($nomeTag);
				if($idTag){
					// Grava o Log 
					if ($num_row > 0) {
						$tagPost['linha'] = "S";
						$tagPost['row'] = $_POST;
						$this->load->view('admin/tagmanter',$tagPost);
					} else {
						$log = "($session_login) [TAG] Alterou TAG do nome ($nomeTag) do id ($idTag)"; 
						$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
						$this->AuditoriaModel->insert($auditoria);
						$this->TagModel->update($_POST['id'],$tag);
						$tagCadastrada = "N";
						Tag::listar(0,$tagCadastrada);
					}
				} else {
					// Grava o Log 
					if ($num_row > 0) {
						$tagPost['linha'] = "S";
						$tagPost['row'] = $_POST;
						$this->load->view('admin/tagmanter',$tagPost);
					} else {
						$log = "($session_login) [TAG] Adicionou TAG do nome ($nomeTag)"; 
						$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
						$this->AuditoriaModel->insert($auditoria);
						$this->TagModel->insert($tag);
						$tagCadastrada = "N";
						Tag::listar(0,$tagCadastrada);
					}
				} 
				
		}
	}
}
?>
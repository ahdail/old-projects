<?php
class Neo extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination'));
		$this->load->model('admin/neomodel',"NeoModel");
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		Neo::listar();
	}
	 
	function listar($start = 0) 
	{
    	$config = array(
    		'base_url' 		=> site_url('/admin/neo/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NeoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->NeoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $neo['pag'] = $this->pagination->create_links();
        $neo['neo'] = $query->result_array();
		$this->load->view('admin/neolistar', $neo);
	}
	// Marca o notícia como: Exibir como Destaque 
	function detalhar($id = 0)
	{
		if ($id) {
	    	$neo['row'] = $this->NeoModel->detalhar($id);
	    	$data = $this->NeoModel->exibirData($id);
	    	$neo['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$neo['autor'] = $this->AutorModel->exibirAutor();
		$this->load->view('admin/neomanter', $neo);
	}
	
	function deletar($id)
	{
		$this->NeoModel->deletar($id);
		Neo::listar();
	}
	
	// Marca o notícia como: Exibir como na Pág. Princiapl
	/*function exibirPrincipal($id,$tipo)
	{
		$artigo = array('exibirPrincipal' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [ARTIGO] Alterou Destaque Artigo do id ($id) para principal ($tipo)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ArtigoModel->exibirLista($id,$artigo);
		Artigo::listar();
	}*/
	
	function manter()
	{	
		//validação
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		// Traz todos os dados do form para Edição
		$neoPost['row'] = $_POST;
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		$neoPost['autor'] = $this->AutorModel->exibirAutor();
		
		if ($this->input->post('exibirPrincipal') == "S") {
			$exibir = "S";
		} else {
			$exibir = "N";
		}
		
		
		// Carregar os dados passado através do formulário
		$neo = array(
			'titulo' 			=> $this->input->post('titulo'),
			'resumo' 			=> $this->input->post('resumo'),
			'data' 				=> $data_nova,
			'conteudo' 			=> $this->input->post('conteudo'),
			'exibirPrincipal'	=> $exibir,
			'idAutor' 			=> $this->input->post('idAutor')
		);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/neomanter',$neoPost);
		} else {
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){
				/*// Grava o Log 
				$log = "($session_login) [ARTIGO] Editou  Artigo do título ($titulo) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);*/
				$this->NeoModel->update($this->input->post('id'), $neo);
			} else {
				/*// Grava o Log 
				$log  = "($session_login) [ARTIGO] Adicionou  Artigo do título ($titulo)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));*/
				$this->NeoModel->insert($neo);
				//$this->AuditoriaModel->insert($auditoria);
			} 
			Neo::listar();
		}		
	}
}
?>
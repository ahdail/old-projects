<?php
class Restaurante extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper('date');
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination'));
		
		// Instânciando as Classe do Model
		$this->load->model('admin/restaurantemodel',"restauranteModel");
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		restaurante::listar();
	}
	
	function listar($start = 0, $idAutor=false) 
	{
		// Exibi o select com todos os autores
	    $restaurante['autor'] = $this->AutorModel->exibirAutor();
	    
    	$config = array(
    		'base_url' 		=> site_url('/admin/restaurante/listar/'),
    		'per_page' 		=> 15,
    		'total_rows' 	=> $this->restauranteModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'num_links' 	=> 19,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
    	$idAutor = $this->input->post('idAutor');
		if($idAutor){
	        $query = $this->restauranteModel->exibirFiltro($start, $config['per_page'], $idAutor);
	        $config['total_rows'] = $this->restauranteModel->getTotalFiltro($idAutor);
		}else{ // Todos os autores
		    $query = $this->restauranteModel->exibir($start, $config['per_page']);
			$config['total_rows'] = $this->restauranteModel->getTotal();
			$restaurante['pag'] = $this->pagination->create_links();
		}		
        $this->pagination->initialize($config);
        $restaurante['pag'] = $this->pagination->create_links();
		
        $restaurante['restaurante'] = $query->result_array();
        
        $restaurante['idAutor'] = $this->input->post('idAutor');
        if ($restaurante['idAutor']){
        	//print_r($restaurante['idAutor']);
        	//die();
        }
		$this->load->view('admin/restaurantelistar',$restaurante);
	}
	// Marca o notícia como: Exibir como Destaque 
	function detalhar($id = 0)
	{
		if ($id) {
	    	$restaurante['row'] = $this->restauranteModel->detalhar($id);
	    	$data = $this->restauranteModel->exibirData($id);
	    	$restaurante['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$restaurante['autor'] = $this->AutorModel->exibirAutor();
		$this->load->view('admin/restaurantemanter',$restaurante);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [restaurante] Deletou restaurante do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->restauranteModel->deletar($id);
		restaurante::listar();
	}
	
	function exibirDestaque($id,$tipo)
	{
		$restaurante = array('exibirDestaque' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [restaurante] Alterou restaurante do id ($id) para destaque ($tipo)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->restauranteModel->exibirLista($id,$restaurante);
		restaurante::listar();
	}
	// Marca o notícia como: Exibir como na Pág. Princiapl
	function exibirPrincipal($id,$tipo)
	{
		$restaurante = array('exibirPrincipal' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [restaurante] Alterou Destaque restaurante do id ($id) para principal ($tipo)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->restauranteModel->exibirLista($id,$restaurante);
		restaurante::listar();
	}
	
	
	function manter()
	{	
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		if ($this->input->post('idAutor') == -1) {
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required');
			$this->form_validation->set_rules('curriculo', 'Currículo', 'required');
		}
		
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			// Traz todos os dados do form para Edição
			$restaurantePost['row'] = $_POST;
			$restaurantePost['autor'] = $this->AutorModel->exibirAutor();
			$this->load->view('admin/restaurantemanter',$restaurantePost);
		} else {
			
			// Resgata o id do autor ou insere um novo
			if ($this->input->post('idAutor') > 0) { 
				$idAutor = $this->input->post('idAutor');
			} else {
				$autor = array(
					'nome' => $this->input->post('nome'),
					'curriculoResumido' => $this->input->post('curriculo'),
					'email' => $this->input->post('email'),
				);
				$idAutor = $this->restauranteModel->insertAutor($autor);
			}
			
			// Atualiza o usuário caso exista algum
			if ($this->input->post('idUsuario')) {
				$usuario['idAutores'] = $idAutor;
				$this->restauranteModel->updateUsuario($this->input->post('idUsuario'), $usuario);
			}
			
			// Carregar os dados passado através do formulário
			if ($this->input->post('tipo') != "D") {
				$tipo = "A";
			} else {
				$tipo = "D";
			}
			$restaurante = array(
				'titulo' => $this->input->post('titulo'),
				'resumo' => $this->input->post('resumo'),
				'data' => $data_nova,
				'conteudo' => $this->input->post('conteudo'),
				'exibirDestaque' => $this->input->post('exibirDestaque'),
				'exibirPrincipal' => $this->input->post('exibirPrincipal'),
				'tipo' => $tipo,
				'bloqueado' => ($this->input->post('bloqueado')) ? 1 : 0,
				'idAutores' => $idAutor
			);
		
			//print_r($restaurante);
			//die();
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			
			if($id){ // Editar
				$this->restauranteModel->update($id, $restaurante);
				
				// Grava o Log 
				$log = "($session_login) [restaurante] Editou  restaurante do título ($titulo) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
			} else { // Adicionar
				$this->restauranteModel->insert($restaurante);
				
				// Grava o Log 
				$log  = "($session_login) [restaurante] Adicionou  restaurante do título ($titulo)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
			} 
			//restaurante::listar();
			$restaurante['autor'] = $this->AutorModel->exibirAutor();
			$restaurante['msg'] = "ok";
			$this->load->view('admin/restaurantemanter',$restaurante);
		}		
	}
	
}
?>
<?php
class Artigo extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper('date');
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination'));
		
		// Instânciando as Classe do Model
		$this->load->model('admin/artigomodel',"ArtigoModel");
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		Artigo::listar();
	}
	
	function listar($start = 0, $idAutor=false) 
	{
		// Exibi o select com todos os autores
	    $artigo['autor'] = $this->AutorModel->exibirAutor();
	    
    	$config = array(
    		'base_url' 		=> site_url('/admin/artigo/listar/'),
    		'per_page' 		=> 15,
    		'total_rows' 	=> $this->ArtigoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'num_links' 	=> 19,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
    	$idAutor = $this->input->post('idAutor');
		if($idAutor){
	        $query = $this->ArtigoModel->exibirFiltro($start, $config['per_page'], $idAutor);
	        $config['total_rows'] = $this->ArtigoModel->getTotalFiltro($idAutor);
		}else{ // Todos os autores
		    $query = $this->ArtigoModel->exibir($start, $config['per_page']);
			$config['total_rows'] = $this->ArtigoModel->getTotal();
			$artigo['pag'] = $this->pagination->create_links();
		}		
        $this->pagination->initialize($config);
        $artigo['pag'] = $this->pagination->create_links();
		
        $artigo['artigo'] = $query->result_array();
        
        $artigo['idAutor'] = $this->input->post('idAutor');
        if ($artigo['idAutor']){
        	//print_r($artigo['idAutor']);
        	//die();
        }
		$this->load->view('admin/artigolistar',$artigo);
	}
	// Marca o notícia como: Exibir como Destaque 
	function detalhar($id = 0)
	{
		if ($id) {
	    	$artigo['row'] = $this->ArtigoModel->detalhar($id);
	    	$data = $this->ArtigoModel->exibirData($id);
	    	$artigo['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$artigo['autor'] = $this->AutorModel->exibirAutor();
		$this->load->view('admin/artigomanter',$artigo);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [ARTIGO] Deletou Artigo do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ArtigoModel->deletar($id);
		Artigo::listar();
	}
	
	function exibirDestaque($id,$tipo)
	{
		$artigo = array('exibirDestaque' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [ARTIGO] Alterou Artigo do id ($id) para destaque ($tipo)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ArtigoModel->exibirLista($id,$artigo);
		Artigo::listar();
	}
	// Marca o notícia como: Exibir como na Pág. Princiapl
	function exibirPrincipal($id,$tipo)
	{
		$artigo = array('exibirPrincipal' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [ARTIGO] Alterou Destaque Artigo do id ($id) para principal ($tipo)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->ArtigoModel->exibirLista($id,$artigo);
		Artigo::listar();
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
			$artigoPost['row'] = $_POST;
			$artigoPost['autor'] = $this->AutorModel->exibirAutor();
			$this->load->view('admin/artigomanter',$artigoPost);
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
				$idAutor = $this->ArtigoModel->insertAutor($autor);
			}
			
			// Atualiza o usuário caso exista algum
			if ($this->input->post('idUsuario')) {
				$usuario['idAutores'] = $idAutor;
				$this->ArtigoModel->updateUsuario($this->input->post('idUsuario'), $usuario);
			}
			
			// Carregar os dados passado através do formulário
			if ($this->input->post('tipo') != "D") {
				$tipo = "A";
			} else {
				$tipo = "D";
			}
			$artigo = array(
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
		
			//print_r($artigo);
			//die();
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			
			if($id){ // Editar
				$this->ArtigoModel->update($id, $artigo);
				
				// Grava o Log 
				$log = "($session_login) [ARTIGO] Editou  Artigo do título ($titulo) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
			} else { // Adicionar
				$this->ArtigoModel->insert($artigo);
				
				// Grava o Log 
				$log  = "($session_login) [ARTIGO] Adicionou  Artigo do título ($titulo)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
			} 
			//Artigo::listar();
			$artigo['autor'] = $this->AutorModel->exibirAutor();
			$artigo['msg'] = "ok";
			$this->load->view('admin/artigomanter',$artigo);
		}		
	}
	
}
?>
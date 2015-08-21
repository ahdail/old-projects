<?php
class Direito extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper('date');
		$this->load->library(array('form_validation','session', 'funcoes', 'pagination'));
		
		// Instânciando as Classe do Model
		$this->load->model('admin/direitomodel',"DireitoModel");
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		Direito::listar();
	}
	 
	function listar($start = 0) 
	{
    	
    	$config = array(
    		'base_url' => site_url('/admin/direito/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->DireitoModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
                
        $query = $this->DireitoModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
       
        // cria links para paginação
        $direto['pag'] = $this->pagination->create_links();
		
        $direito['direito'] = $query->result_array();
		$this->load->view('admin/direitolistar',$direito);
	}
	// Marca o notícia como: Exibir como Destaque 
	function detalhar($id)
	{
		if ($id) {
	    	$direito['row'] = $this->DireitoModel->detalhar($id);
	    	$data = $this->DireitoModel->exibirData($id);
	    	$direito['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$direito['autor'] = $this->AutorModel->exibirAutor();
		$this->load->view('admin/direitomanter',$direito);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$log  = "Deletou Direito Empresarial"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->DireitoModel->deletar($id);
		Direito::listar();
	}
	
	function manter()
	{	
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		// Traz todos os dados do form para Edição
		$direitoPost['row'] = $_POST;
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		$direitoPost['autor'] = $this->AutorModel->exibirAutor();
		// Carregar os dados passado através do formulário
		$direito = array(
			'titulo' => $this->input->post('titulo'),
			'resumo' => $this->input->post('resumo'),
			'data' => $data_nova,
			'conteudo' => $this->input->post('conteudo'),
			'idAutor' => $this->input->post('idAutor')
		);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/direitomanter',$direitoPost);
		} else {
			if($this->input->post('id')){
				// Grava o Log 
				$log  = "Editou Direito Empresarial"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->DireitoModel->update($this->input->post('id'),$direito);
			} else {
				// Grava o Log 
				$log  = "Adicionou Direito Empresarial"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->DireitoModel->insert($direito);
				$this->AuditoriaModel->insert($auditoria);
			} 
			Direito::listar();
		}		
	}
}
?>
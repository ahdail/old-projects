<?php
class Juizo extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper('date');
		$this->load->library(array('form_validation','session', 'funcoes', 'pagination'));
		
		// Instânciando as Classe do Model
		$this->load->model('admin/juizomodel',"JuizoModel");
		$this->load->model('admin/autormodel',"AutorModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		Juizo::listar();
	}
	 
	function listar($start = 0) 
	{
    	
    	$config = array(
    		'base_url' => site_url('/admin/juizo/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->JuizoModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
                
        $query = $this->JuizoModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
       
        // cria links para paginação
        $juizo['pag'] = $this->pagination->create_links();
		
        $juizo['juizo'] = $query->result_array();
		$this->load->view('admin/juizolistar',$juizo);
	}
	// Marca o notícia como: Exibir como Destaque 
	function detalhar($id)
	{
		if ($id) {
	    	$juizo['row'] = $this->JuizoModel->detalhar($id);
	    	$data = $this->JuizoModel->exibirData($id);
	    	$juizo['row']['data'] = $this->funcoes->converte_data($data['data']);
		} 
		$juizo['autor'] = $this->AutorModel->exibirAutor();
		$this->load->view('admin/juizomanter',$juizo);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$log  = "Deletou Juizo"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->JuizoModel->deletar($id);
		Juizo::listar();
	}
	
	function manter()
	{	
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		// Traz todos os dados do form para Edição
		$juizoPost['row'] = $_POST;
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		$juizoPost['autor'] = $this->AutorModel->exibirAutor();
		// Carregar os dados passado através do formulário
		$juizo = array(
			'titulo' => $this->input->post('titulo'),
			'resumo' => $this->input->post('resumo'),
			'data' => $data_nova,
			'conteudo' => $this->input->post('conteudo'),
			'idAutor' => $this->input->post('idAutor')
		);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/juizomanter',$juizoPost);
		} else {
			if($this->input->post('id')){
				// Grava o Log 
				$log  = "Editar"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->JuizoModel->update($this->input->post('id'),$juizo);
			} else {
				// Grava o Log 
				$log  = "Adicionou"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->JuizoModel->insert($juizo);
				$this->AuditoriaModel->insert($auditoria);
			} 
			Juizo::listar();
		}		
	}
}
?>
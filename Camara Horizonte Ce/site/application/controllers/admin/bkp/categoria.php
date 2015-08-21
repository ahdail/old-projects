<?php
class Categoria extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','funcoes', 'pagination'));
		$this->load->model('admin/categoriamodel',"CategoriaModel");
	}
	function index() 
	{
		Categoria::listar();
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$categoria['row'] = $this->CategoriaModel->detalhar($id);
		}
		$this->load->view('admin/categoriamanter',$categoria);
	}
	
	function deletar($id) 
	{
		$this->CategoriaModel->deletar($id);
		Categoria::listar();		
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('nome', 'Nome', 'required');
				
		$categoriaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/categoriamanter', $categoriaPost);
		} else {
			$categoria = array(				
				'nome' => $this->input->post('nome')			
			);

			$idcategoria = $this->input->post('id');
			if($idcategoria){
				$this->CategoriaModel->update($idcategoria, $categoria);
			} else {				
				$this->CategoriaModel->insert($categoria);
			} 
			Categoria::listar();
		}		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/categoria/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->CategoriaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->CategoriaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $categoria['pag'] = $this->pagination->create_links();
        $categoria['categoria'] = $query->result_array();
		
		$this->load->view('admin/categorialistar',$categoria);
	}

	
}
?>
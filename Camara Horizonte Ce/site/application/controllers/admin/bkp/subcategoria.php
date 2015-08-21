<?php
class SubCategoria extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','funcoes', 'pagination'));
		$this->load->model('admin/categoriamodel',"CategoriaModel");
		$this->load->model('admin/subcategoriamodel',"SubCategoriaModel");
	}
	function index() 
	{
		$subcategoria['categoria'] = $this->CategoriaModel->todas();
		$this->load->view('admin/subcategoriamanter',$subcategoria);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$subcategoria['row'] = $this->SubCategoriaModel->detalhar($id);
		}
		$subcategoria['categoria'] = $this->CategoriaModel->todas();
		$this->load->view('admin/subcategoriamanter',$subcategoria);
	}
	
	function deletar($id) 
	{
		$this->SubCategoriaModel->deletar($id);
		SubCategoria::listar();		
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('idCategoria', 'Categoria', 'required');
		$this->form_validation->set_rules('nome', 'Subcategoria', 'required');
				
		$subcategoriaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$subcategoriaPost['categoria'] = $this->CategoriaModel->todas();
			$this->load->view('admin/subcategoriamanter', $subcategoriaPost);
		} else {
			$subcategoria = array(				
				'idCategoria' => $this->input->post('idCategoria'),
				'nome' => $this->input->post('nome')			
			);
			
			$idsubcategoria = $this->input->post('id');
			if($idsubcategoria){
				$this->SubCategoriaModel->update($idsubcategoria, $subcategoria);
			} else {				
				$this->SubCategoriaModel->insert($subcategoria);
			} 
			
			SubCategoria::listar();
		}		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/subcategoria/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->SubCategoriaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->SubCategoriaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $subcategoria['pag'] = $this->pagination->create_links();
        $subcategoria['subcategoria'] = $query->result_array();

		$this->load->view('admin/subcategorialistar',$subcategoria);
	}

	
}
?>
<?php
class Produto extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','funcoes', 'pagination'));
		$this->load->model('admin/produtomodel',"ProdutoModel");
		$this->load->model('admin/categoriamodel',"CategoriaModel");
		$this->load->model('admin/subcategoriamodel',"SubCategoriaModel");
		$this->load->model('admin/fabricantemodel',"FabricanteModel");
	}
	function index() 
	{
		$produto['categoria'] = $this->CategoriaModel->todas();
		$produto['subcategoria'] = $this->SubCategoriaModel->todas();
		$produto['fabricante'] = $this->FabricanteModel->todos();
		$this->load->view('admin/produtomanter', $produto);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$produto['row'] = $this->ProdutoModel->detalhar($id);
		}
		$produto['categoria'] = $this->CategoriaModel->todas();
		$produto['subcategoria'] = $this->SubCategoriaModel->todas();
		$produto['fabricante'] = $this->FabricanteModel->todos();
		$this->load->view('admin/produtomanter',$produto);
	}
	
	function deletar($id) 
	{
		$this->ProdutoModel->deletar($id);
		Produto::listar();		
		
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() 
	{
		
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('idCategoria', 'Categoria', 'required');
		$this->form_validation->set_rules('idSubcategoria', 'Sub Categoria', 'required');
		$this->form_validation->set_rules('idFabricante', 'Fabricante', 'required');
		$this->form_validation->set_rules('especificacao', 'Especificação', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
				
		$produtoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){	
			$produtoPost['categoria'] = $this->CategoriaModel->todas();
			$produtoPost['subcategoria'] = $this->SubCategoriaModel->todas();
			$produtoPost['fabricante'] = $this->FabricanteModel->todos();
			$this->load->view('admin/produtomanter', $produtoPost);
		} else {
			$produto = array(				
				'nome' => $this->input->post('nome'),
				'idCategoria' => $this->input->post('idCategoria'),
				'idSubcategoria' => $this->input->post('idSubcategoria'),
				'idFabricante' => $this->input->post('idFabricante'),
				'especificacao' => $this->input->post('especificacao'),
				'descricao' => $this->input->post('descricao'),
				'destaque' => $this->input->post('destaque')
				
			);
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/produtos';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/fabricantemanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/produtos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 100,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$produto ['thumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					$produto ['imagem1'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			
			$idproduto = $this->input->post('id');
			if($idproduto){
				$this->ProdutoModel->update($idproduto, $produto);
			} else {				
				$this->ProdutoModel->insert($produto);
			} 
			
			Produto::listar();
		}		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/produto/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ProdutoModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ProdutoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $produto['pag'] = $this->pagination->create_links();
        $produto['produto'] = $query->result_array();

		$this->load->view('admin/produtolistar',$produto);
	}

}
?>
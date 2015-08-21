<?php
class ColecaoFoto extends Controller {

	function __construct() 
	{
		parent::Controller();		
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/colecaomodel',"ColecaoModel");
		$this->load->model('admin/colecaofotomodel',"ColecaoFotoModel");
	}
	function index() 
	{		
		$colecoes['colecao'] = $this->ColecaoModel->todasColecoes();		
		$this->load->view('admin/colecaofotomanter', $colecoes);
	}

	function pesquisar()
	{
		$colecoes['colecao'] = $this->ColecaoModel->todasColecoes();
		$this->load->view('admin/colecaofotolistar', $colecoes);
	}
	
	function listar($start = 0)  
	{
		$idcolecao = $this->input->post('idcolecao');
		
		$config = array(
    		'base_url' 		=> site_url('/admin/colecaofoto/listar/'.$idcolecao.''),
    		'per_page' 		=> 100,
    		'total_rows' 	=> $this->ColecaoFotoModel->getTotal($idcolecao),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ColecaoFotoModel->exibir($start, $config['per_page'], $idcolecao);
        $this->pagination->initialize($config);
        $colecaofoto['pag'] = $this->pagination->create_links();
        $colecaofoto['colecaofoto'] = $query->result_array();
		$colecaofoto['colecao'] = $this->ColecaoModel->todasColecoes();

		$this->load->view('admin/colecaofotolistar', $colecaofoto);
	}

	function detalhar($id=0) 
	{
		if ($id) {
	    	$colecaofoto['row'] = $this->ColecaoFotoModel->detalhar($id);
		}
		
		$colecaofoto['colecao'] = $this->ColecaoModel->todasColecoes();
		$this->load->view('admin/colecaofotomanter', $colecaofoto);
	}

	function deletar($id)
	{
		$this->ColecaoFotoModel->deletar($id);
		ColecaoFoto::listar();
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

		$this->form_validation->set_rules('idcolecao', 'Colecao', 'required');
		
		$colecaoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/colecaofotomanter', $colecaoPost);
		} else {
			$colecaofoto = array(
				'idColecao' => $this->input->post('idcolecao'),
				'descricao' => $this->input->post('descricao')
			);
			
		// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/colecao_fotos';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/colecaofotomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/colecao_fotos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 100,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$colecaofoto ['fotoColecaoThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					$colecaofoto ['fotoColecao'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}

			
			$idcolecaofoto = $this->input->post('id');
			if($idcolecaofoto){				
				$this->ColecaoFotoModel->update($idcolecaofoto, $colecaofoto);
			} else {		
				$this->ColecaoFotoModel->insert($idcolecaofoto);
			} 
			ColecaoFoto::listar();
		}
	}
}
?>
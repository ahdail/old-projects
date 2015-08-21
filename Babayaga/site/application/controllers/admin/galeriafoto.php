<?php
class GaleriaFoto extends Controller {

	function __construct() 
	{
		parent::Controller();		
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->model('admin/galeriamodel',"GaleriaModel");
		$this->load->model('admin/galeriafotomodel',"GaleriaFotoModel");
	}
	function index() 
	{		
		$galerias['galeria'] = $this->GaleriaModel->todasGalerias();		
		$this->load->view('admin/galeriafotomanter', $galerias);
	}

	function pesquisar()
	{
		$galerias['galeria'] = $this->GaleriaModel->todasGalerias();
		$this->load->view('admin/galeriafotolistar', $galerias);
	}
	
	function deletar($id)
	{
		$this->GaleriaFotoModel->deletar($id);
		GaleriaFoto::listar();
	}
	
	function listar($start = 0)  
	{
		$idgaleria = $this->input->post('idgaleria');
		
		$config = array(
    		'base_url' 		=> site_url('/admin/galeriafoto/listar/'.$idgaleria.''),
    		'per_page' 		=> 100,
    		'total_rows' 	=> $this->GaleriaFotoModel->getTotal($idgaleria),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->GaleriaFotoModel->exibir($start, $config['per_page'], $idgaleria);
        $this->pagination->initialize($config);
		
        $galeriafoto['pag'] = $this->pagination->create_links();
        $galeriafoto['galeriafoto'] = $query->result_array();
		
		$galeriafoto['galeria'] = $this->GaleriaModel->todasGalerias();

		$this->load->view('admin/galeriafotolistar', $galeriafoto);
	}

	function detalhar($id=0) 
	{
		if ($id) {
	    	$galeriafoto['row'] = $this->GaleriaFotoModel->detalhar($id);
		}
		
		$galeriafoto['galeria'] = $this->GaleriaModel->todasGalerias();
		
		$this->load->view('admin/galeriafotomanter', $galeriafoto);
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

		$this->form_validation->set_rules('idgaleria', 'Galeria', 'required');
		
		$galeriaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/galeriafotomanter', $galeriaPost);
		} else {
			$galeriafoto = array(
				'idGaleria' => $this->input->post('idgaleria'),
				'descricao' => $this->input->post('descricao')
			);
			
		// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/galeria_fotos';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/galeriafotomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/galeria_fotos',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 100,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'auto' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$galeriafoto ['fotoGaleriaThumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];					
					$galeriafoto ['fotoGaleria'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}

			
			$idgaleriafoto = $this->input->post('id');
			if($idgaleriafoto){				
				$this->GaleriaFotoModel->update($idgaleriafoto, $galeriafoto);
			} else {		
				$this->GaleriaFotoModel->insert($galeriafoto);
			} 
			GaleriaFoto::listar();
		}
	}
}
?>
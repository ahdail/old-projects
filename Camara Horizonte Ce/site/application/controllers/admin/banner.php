<?php
class Banner extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/bannermodel',"BannerModel");
	}
	function index() 
	{
		Banner::listar();	
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$banner['row'] = $this->BannerModel->detalhar($id);
		}
		
		$this->load->view('admin/bannermanter', $banner);
	}
	
	function deletar($id) 
	{
		$this->BannerModel->deletar($id);
		Banner::listar();
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo Foto é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() 
	{
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		
		$this->form_validation->set_rules('mostrar', 'Mostrar no site', 'required');

		
		$bannerPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			//$bannerPost['banner'] = $this->BannerModel->albuns($id);
			$this->load->view('admin/bannermanter', $bannerPost);
		} else {
			$banner = array(				
				'mostrar'	=> $this->input->post('mostrar'),				
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/banners';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/videomanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					//create thumbnail
					$config = array(
						'source_image' => $data['full_path'], 
						'new_image' => $this->gallery_path . 'site/banners',
						'maintain_ratio' => true,
						'width' => 100,
					    'height' => 40,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb',
						'master_dim' => 'width' 					 
					);
					
				    $this->load->library('image_lib', $config); 
					$this->image_lib->resize();
					
					$banner ['thumb'] = $data ['raw_name'].$config['thumb_marker'].$data ['file_ext'];	
					$banner ['imagem'] = $data ['raw_name'] . $data ['file_ext'];								
					
				}
			}
				
			$idbanner = $this->input->post('id');
			if($idbanner){			
				$this->BannerModel->update($idbanner, $banner);
			} else {						
				$this->BannerModel->insert($banner);
			} 
			Banner::listar();
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/banner/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->BannerModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
                
        $query = $this->BannerModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $banner['pag'] = $this->pagination->create_links();
        $banner['banner'] = $query->result_array();
		
		$this->load->view('admin/bannerlistar',$banner);
	}
	
}
?>
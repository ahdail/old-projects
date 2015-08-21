<?php
class Anuncie extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		$this->load->helper ( array ('form', 'url', 'date') );
		$this->load->library ( array ('form_validation', 'session', 'pagination'));
		$this->load->model ('admin/anunciemodel', "AnuncieModel");
		//$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		Anuncie::listar($id);
	}
	
	function listar($start = 0) 
	{
			$config = array(
    		'base_url' 		=> site_url('/admin/anuncie/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->AnuncieModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
                
        $query = $this->AnuncieModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        
        $anuncie['pag'] = $this->pagination->create_links();
        $anuncie['anuncie'] = $query->result_array();
		$this->load->view('admin/anuncielistar', $anuncie);
	}
	
	function deletar($id) {
		// Grava o Log 
		$this->AnuncieModel->deletar($id);
		anuncie::listar();
	}
	
	function detalhar($id=0, $variaveis=false) {
		// Se tiver id, traz o detalhamento do banco
		if ($id) $var['row'] = $this->anuncieModel->detalhar($id);
		
		// Se nao tiver id, e tiver retornando um post, passa pra variavel
		if ($variaveis) $var = $variaveis;
		
		$this->load->view('admin/anunciemanter', $var);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo й obrigatуrio');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() {
		// Validaзгo.
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('resumo', 'resumo', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->detalhar(0, array("row" => $_POST)); // Chama a view de detalhes
		} else {
			// Carrega o array que serб inserido no banco
			$anuncie = array(
				'titulo' => $this->input->post('titulo'),
				'tipo' => $this->input->post('tipo'),
				'autorizado' => $this->input->post('autorizado'),
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/modelos/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					
					$this->detalhar(0, $var); // Chama a view de detalhes
					
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$anuncie['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			if (!$var['error']) {
				$session_login = $this->session->userdata('login');
				$tituloanuncie = $this->input->post('titulo');
				$idanuncie = $this->input->post('id');
				if ($idanuncie) {
					// Grava o Log 
					$this->anuncieModel->update($idanuncie, $anuncie);
				} else {
					$this->anuncieModel->insert($anuncie);
				}
				$this->listar ();
			}
		}
	}
}
?>
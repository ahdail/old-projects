<?php
class Loja extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/lojamodel',"LojaModel");
	}
	
	function index()
	{
		loja::listar();
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/admin/loja/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->LojaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima'
    	);
                
        $query = $this->LojaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $loja['pag'] = $this->pagination->create_links();
		
        $loja['loja'] = $query->result_array();
        
        $this->load->view('admin/lojalistar', $loja);
	}
	
	
	function deletar($id)
	{
		// Grava o Log 
		$loja['row'] = $this->LojaModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $loja['row']['titulo'], $loja['row']['id'], "Excluiu [Link Loja]");
		$this->auditoria->gravar();
		
		$this->LojaModel->deletar($id);
		Loja::listar();
	}
	
	function detalhar($id = 0,$variaveis=false) {
		if ($id) {
			$var['row'] = $this->LojaModel->detalhar($id);
		}
		if ($variaveis) $var = $variaveis;
		$this->load->view('admin/lojamanter', $var);
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
		$this->form_validation->set_rules('url', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->detalhar(0, array("row" => $_POST)); 
		} else {
			// Carrega o array que serб inserido no banco
			$loja = array(
				'nome' 		=> $this->input->post('nome'),
				'url' 		=> $this->input->post('url'),
				'descricao' => $this->input->post('descricao'),
				'exibir' 	=> $this->input->post('aut')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] 		= 'site/banners/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size'] 		= '0';
				$config['max_width'] 		= '0';
				$config['max_height'] 		= '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					$this->detalhar(0, $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$loja ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			if(!$var['error']) {
					$session_login = $this->session->userdata('login');
					$url = $this->input->post('url');
					$idLoja = $this->input->post('id');
				if ($idLoja) { // Ediзгo
					$this->LojaModel->update($idLoja, $loja);
					// Grava Log
					$this->auditoria->carregar($session_login, $url, $idLoja, "Editou [Link Loja]");
					$this->auditoria->gravar();
				} else {
					$this->LojaModel->insert($loja);
					// Grava Log
					$this->auditoria->carregar($session_login, $nome, $idLoja, "Adicionou [Link Loja]");
					$this->auditoria->gravar();
				}
				$this->listar(0,$idLoja);
			}
		}
	}
	
}
?>
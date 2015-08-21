<?php
class QuemSomos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/quemsomosmodel',"QuemSomosModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		QuemSomos::listar();
	}
	 
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/quemsomos/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->QuemSomosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->QuemSomosModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $quemsomos['pag'] = $this->pagination->create_links();
        $quemsomos['quemsomos'] = $query->result_array();
		$this->load->view('admin/quemsomoslistar',$quemsomos);
	}
	
	function detalhar($id=0)
	{
		if ($id) {
	    	$quemsomos['row'] = $this->QuemSomosModel->detalhar($id);
		}
		$this->load->view('admin/quemsomosmanter',$quemsomos);
	}
	
	function deletar($id)
	{
		// Log
		$quemsomos['row'] = $this->QuemSomosModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $quemsomos['row']['titulo'], $quemsomos['row']['id'], "Excluiu [QUEM SOMOS]");
		$this->auditoria->gravar();
		
		$this->QuemSomosModel->deletar($id);
		//QuemSomos::listar();
		$this->listar();
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
		$this->form_validation->set_rules('definicao', 'Definicao', 'required');
		
		$QuemSomosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/quemsomosmanter', $QuemSomosPost);
		} else {
			$QuemSomos = array(
				'quemSomos' 			=> $this->input->post('definicao'),
				'diretoria' 			=> $this->input->post('diretoria'),
				'nomePresidente' 		=> $this->input->post('nomePresidente'),
				'descricaoPresidente'	=> $this->input->post('descricaoPresidente'),
			);
			
		// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/img/';
				$config['allowed_types'] = 'gif|jpg|png|';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/quemsomosmanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$QuemSomos ['fotoPresidente'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			//print_r($QuemSomos);
			$session_login = $this->session->userdata('login');
			$email = $this->input->post('email');
			$idquemsomos = $this->input->post('id');
			if($idquemsomos){
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idquemsomos, "Editou [QUEM SOMOS]");
				$this->auditoria->gravar();
				$this->QuemSomosModel->update($idquemsomos, $QuemSomos);
			} else {
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idQuemSomos, "Adicionou [QUEM SOMOS]");
				$this->auditoria->gravar();
				
				$this->QuemSomosModel->insert($QuemSomos);
			} 
			QuemSomos::listar();
		}		
	}
}
?>
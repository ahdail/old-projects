<?php
class CicloDebate extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/ciclodebatemodel',"CicloDebateModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	/** Programa */
	function index (){
		$this->load->view('admin/programaListar',$programa);
	}
	function programaListar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/clicoDebate/programaListar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->CicloDebateModel->videoGetTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->CicloDebateModel->programaExibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $programa['pag'] = $this->pagination->create_links();
        $programa['programa'] = $query->result_array();
		$this->load->view('admin/programalistar',$programa);
		//$this->load->view('admin/programaManter',$programa);
	}
	
	function programaDetalhar($id=0)
	{
		if ($id) {
	    	$programa['row'] = $this->CicloDebateModel->programaDetalhar($id);
	    	$programa['videos'] = $this->programaExibirVideo($id);
		}
		$this->load->view('admin/programaManter',$programa);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$programa['row'] = $this->CicloDebateModel->programaDetalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $programa['row']['titulo'], $programa['row']['id'], "Excluiu [PROGRAMA]");
		$this->auditoria->gravar();
		
		$this->CicloDebateModel->programaDeletar($id);
		CicloDebate::programaListar();
	}
	
	function opcao($id,$opcao)
	{
		$exibir = array('exibir' => $opcao);
		$this->CicloDebateModel->opcao($id,$exibir);
		CicloDebate::programaListar();	
	}
	
	
	function programaManter()
	{	
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		
		$programaPost['row'] = $_POST;
		
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		$programa = array(
			'titulo' => $this->input->post('titulo'),
			'data' => $data_nova,
			'resumo' => $this->input->post('resumo'),
			'exibir' => $this->input->post('exibir')
		);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/programaManter',$programaPost);
		} else {
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			if($id){
				// Grava o Log 
				
				$session_login = $this->session->userdata('login'); 
				$this->auditoria->carregar($session_login, $titulo, $id, "Editou [PROGRAMA]");
				$this->auditoria->gravar();
				
				$this->CicloDebateModel->programaUpdate($id,$programa);
			} else {
				// Grava o Log 
				$session_login = $this->session->userdata('login'); 
				$this->auditoria->carregar($session_login, $titulo, $id, "Adicionou [PROGRAMA]");
				$this->auditoria->gravar();
				
				$this->CicloDebateModel->programaInsert($programa);
			} 
			CicloDebate::programaListar();
		}		
	}
	
	/** Videos */
	function programaExibirVideo($idPrograma, $forcarEcho = false) {
		$this->load->helper('request');
		
		$var['video'] = $this->CicloDebateModel->programaExibirVideo($idPrograma);
		$var['idPrograma'] = $idPrograma;
		
		$retorno = $this->load->view('admin/programaVideoListar',$var, true);
		
		if (is_ajax() or $forcarEcho) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	function programaDetalharVideo() {
		$this->load->helper('request');
		
		$idPrograma = $this->input->post('idPrograma');
		$idVideo = $this->input->post('idVideo');
		
		if ($idVideo) {
	    	$video['row'] = $this->CicloDebateModel->programaDetalharVideo($idVideo);
		}
		$video['idPrograma'] = $idPrograma;
		
		$retorno = $this->load->view('admin/programaVideoManter',$video, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	function validaArquivo($str) {
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo FLV é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	
	function validaParteUnica($parte) {
		$invalido = $this->CicloDebateModel->verficaVideoParteUnica($parte, $this->input->post('idPrograma'));
		if ($invalido) {
			$this->form_validation->set_message('validaParteUnica', 'Já existe um vídeo nessa parte');
			return false;
		} else {
			return true;
		}
	} 
	
	function programaManterVideo() {
		$idVideo = $this->input->post('idVideo');
		$idPrograma = $this->input->post('idPrograma');

		if ($idVideo == 0) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
			$this->form_validation->set_rules('parte', 'parte', 'callback_validaParteUnica');
		}
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');

		if ($this->form_validation->run () == FALSE) {
			$videoPost['row'] = $_POST;
			$videoPost['idPrograma'] = $idPrograma;
			$this->load->view('admin/programaVideoManter', $videoPost);
		} else {
			// Carrega o array que será inserido no banco
			$video = array(
				'parte' 	 => $this->input->post('parte'),
				'resumo' 	 => $this->input->post('resumo'),
				'idPrograma' => $this->input->post('idPrograma')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/videos/';
				$config['allowed_types'] = 'flv';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error['error'] = $this->upload->display_errors();
					$error['row'] = $_POST;
					$error['idPrograma'] = $idPrograma;
					$this->load->view ('admin/programaVideoManter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$video ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			$session_login = $this->session->userdata('login');
			
			if ($idVideo) { // Alterar
				$this->CicloDebateModel->videoUpdate($idVideo, $video);
				
			} else { // Inserir
				$this->CicloDebateModel->videoInsert($video);
			}
			
			
			// Grava o Log 
			$video['row'] = $this->CicloDebateModel->programaDetalharVideo($idVideo);
			$session_login = $this->session->userdata('login');
			$this->auditoria->carregar($session_login, "Parte ".$video['row']['parte']." do Programa ".$video['row']['idPrograma'], $idVideo, "Alterou [CICLO DEBATE]");
			$this->auditoria->gravar();
			
			$this->programaExibirVideo($idPrograma, true);
		}
	}
	
	function programaVideoDeletar($idPrograma, $idVideo)
	{
		
		// Grava o Log 
		$video['row'] = $this->CicloDebateModel->programaDetalharVideo($idVideo);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, "Parte ".$video['row']['parte']." do Programa ".$idPrograma, $idVideo, "Excluiu [CICLO DEBATE]");
		$this->auditoria->gravar();
		// Deleta
		$this->CicloDebateModel->videoDeletar($idVideo);
		
		// Exibe a listagem de videos
		$this->programaExibirVideo($idPrograma);
	}
}
?>
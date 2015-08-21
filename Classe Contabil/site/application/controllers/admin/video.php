<?php
class Video extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		$this->load->helper ( array ('form', 'url', 'date' ) );
		$this->load->library ( array ('form_validation', 'session', 'pagination','upload') );
		$this->load->library('upload');
		$this->load->model ( 'admin/videomodel', "VideoModel" );
		$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		Video::listar($id);
	}
	
	function listar($start = 0) 
	{
			$config = array(
    		'base_url' => site_url('/admin/video/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->VideoModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'ï¿½ltima'
    	);
                
        $query = $this->VideoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $video['pag'] = $this->pagination->create_links();
        $video['video'] = $query->result_array();
		$this->load->view('admin/videolistar', $video );
	}
	/* Funï¿½ï¿½o serve para escolher se o banner serï¿½ exibido ou nï¿½o no site.
	*  E tambï¿½m ï¿½ possivel determinar se o banner abrirï¿½ em uma nova janela(_blank) ou nï¿½o. 
	*  $id: o id do banner no banco de dados
	*  $tipo: Determina se o banner sera exibido no site e/ou nova janela - S(Sim) e N(Nï¿½o)
	*  $qualCheck: Determina qual o campo da tabela serï¿½ atualizado
	* */ 
	function exibir($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner serï¿½ atualizado, com o valor preenchido da variï¿½vel $tipo
		$session_login = $this->session->userdata('login');
		$video = array ('exibir' => $tipo );
		$log = "($session_login) [Vï¿½DEO] Alterou o  Vï¿½deo exibir para ($tipo) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->VideoModel->opcao($id, $video);
		Video::listar();
	}
	
	
	function deletar($id) {
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [Vï¿½DEO] Deletou Vï¿½deo do id ($id)";
		$deletar['arquivo'] = $this->VideoModel->detalhar($id);
		$caminho = "/srv/www/dominiosv/classecontabil/html/v3/site/videos/".$deletar['arquivo']['arquivo'];
		//C:/xampp/htdocs/EquipePi/classe/ci/site/videos/
		unlink($caminho);
		$auditoria = array ('log' => $log, 'dataHora' => date ("Y-m-d h:i:s", now ()));
		$this->AuditoriaModel->insert ( $auditoria );
		$this->VideoModel->deletar($id);
		Video::listar();
	}
	
	function detalhar($id = 0,$variaveis=false) {
		if ($id) {
			$var['row'] = $this->VideoModel->detalhar($id);
		}
		if ($variaveis) $var = $variaveis;
		$this->load->view('admin/videomanter', $var);
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
	
	
	function manter() {
		
		
		// Validaï¿½ï¿½o.
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->detalhar(0, array("row" => $_POST)); 
		} else {
			// Carrega o array que serï¿½ inserido no banco
			$video = array(
				'titulo' 	=> $this->input->post('titulo'),
				'resumo' 	=> $this->input->post('resumo'),
				'exibir' 	=> $this->input->post('exibir')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/videos/';
				$config['allowed_types'] = 'flv';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->upload->initialize($config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					
					$this->detalhar(0, $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$video ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			
			if (!$var['error']) {
				$session_login = $this->session->userdata('login');
				$tituloVideo = $this->input->post('titulo');
				$idVideo = $this->input->post('id');
				
				if ($idVideo) {
					// Grava o Log 
					$log = "($session_login) [Vï¿½DEO] Alterou Vï¿½deo do tï¿½tulo ($tituloVideo) do id ($idVideo) ";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->VideoModel->update($idVideo, $video);
				} else {
					// Grava o Log 
					$log = "($session_login) [Vï¿½DEO] Adicionou Vï¿½deo com o titulo ($tituloVï¿½deo)";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->VideoModel->insert($video);
				}
				$this->listar();
			}	
		}
	}
	
	function comentario()
	{
		$config = array(
    		'base_url' => site_url('/admin/video/comentario/'),
    		'per_page' => 10,
    		'total_rows' => $this->VideoModel->getTotalComentario(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'ï¿½ltima'
    	);
                
        $query = $this->VideoModel->exibirComentario($start, $config['per_page']);
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        $var['videoComentario'] = $query->result_array();
		$this->load->view('admin/video_comentario', $var );	
	
	}
	
	function comentarioDeletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [COMENTÀRIOS VIDEOS] Deletou Comentario do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->VideoModel->comentarioDeletar($id);
		
		$this->comentario();
	}
	
	function comentarioDetalhar($id)
	{
		if ($id) {
			// Faz o select
			$comentario['row'] = $this->VideoModel->comentarioDetalhar($id);
		}
		$this->load->view('admin/video_comentario_manter',$comentario);
	}
	
	function comentarioManter()
	{

		// Realiza a validação dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Comentário', 'required' );
		
		// Carregar os dados passado através do formulário
		$comentario = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		
		
		// Carrega todos os dados num array para serem editados
		$comentarioPost['row'] = $_POST;
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/video_comentario_manter',$comentarioPost);
		} else {
			// Edição
			$session_login = $this->session->userdata('login');
			$nomeComentario = $this->input->post('comentario');
			$idComentario = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENTÁRIO VÍDEOS] Alterou Comentário($nomeComentario) do id ($idComentario)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->VideoModel->updateComentario($idComentario,$comentario);
			// Adição
			
			if ($this->input->post('autorizado') == "S") {
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Comentário[VÍDEOS] Autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu comentário[VÍDEOS] foi autorizado e está disposnivel no site.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 	
			}	
				
			$this->comentario();
		}
	}
	
	function opcaoComentario($id,$tipo)
	{
		$session_login = $this->session->userdata('login');
		$autorizado = array ('autorizado' => $tipo );
		$log = "($session_login) [COMENTARIO VÍDEOS] Alterou o  comentário dos videos autorização para ($autorizado) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->VideoModel->opcaoComentario($id, $autorizado);
		if ($tipo == "S") {
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Comentário[VÍDEOS] Autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu comentário[VÍDEOS] foi autorizado e está disposnivel no site.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 	
			}	
		$this->comentario();
	}
}
?>
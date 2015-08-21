<?php
class PodClasse extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper ( array ('form', 'url', 'date') );
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'funcoes') );
		
		// Inst�nciando as Classe do Model
		$this->load->model ( 'admin/PodClasseModel', "PodClasseModel" );
		$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		PodClasse::listar($id);
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/admin/podClasse/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->PodClasseModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => '�ltima'
    	);
                
        $query = $this->PodClasseModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para pagina��o
        $podClasse['pag'] = $this->pagination->create_links();
		
        $podClasse['podClasse'] = $query->result_array();
        
		$this->load->view('admin/podClasseListar',$podClasse);
	}
	/* Fun��o serve para escolher se o banner ser� exibido ou n�o no site.
	*  E tamb�m � possivel determinar se o banner abrir� em uma nova janela(_blank) ou n�o. 
	*  $id: o id do banner no banco de dados
	*  $tipo: Determina se o banner sera exibido no site e/ou nova janela - S(Sim) e N(N�o)
	*  $qualCheck: Determina qual o campo da tabela ser� atualizado
	* */ 
	function exibir($id, $tipo) 
	{
		// Se for  1 o campo exibir da tabela Banner ser� atualizado, com o valor preenchido da vari�vel $tipo
		$session_login = $this->session->userdata('login');
		$podClasse = array ('exibir' => $tipo );
		$log = "($session_login) [V�DEO] Alterou o  V�deo exibir para ($tipo) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->PodClasseModel->opcao($id, $podClasse);
		PodClasse::listar();
	}
	
	
	function deletar($id) {
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [V�DEO] Deletou V�deo do id ($id)";
		$deletar['arquivo'] = $this->PodClasseModel->detalhar($id);
		$caminho = "/srv/www/dominiosv/classecontabil/html/v3/site/podclasse/".$deletar['arquivo']['arquivo'];
		////C:/xampp/htdocs/EquipePi/classe/ci/site/podclasse/
		unlink($caminho);
		$auditoria = array ('log' => $log, 'dataHora' => date ("Y-m-d h:i:s", now ()));
		$this->AuditoriaModel->insert ( $auditoria );
		$this->PodClasseModel->deletar($id);
		PodClasse::listar();
	}
	
	function detalhar($id = 0,$variaveis=false) {
		if ($id) {
			$var['row'] = $this->PodClasseModel->detalhar($id);
		}
		if ($variaveis) $var = $variaveis;
		$this->load->view('admin/podClasseManter',$var);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo � obrigat�rio');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() {
		// Valida��o.
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		

		if ($this->form_validation->run() == false) {
			$var = array(
				"error" => $this->upload->display_errors(),
				"row" => $_POST
			);
			$this->detalhar(0, $var);
		} else {
			// Carrega o array que ser� inserido no banco
			$podClasse = array(
				'titulo' => $this->input->post('titulo'),
				'data' => $this->funcoes->converte_data($this->input->post('data')),
				'arquivo' => $this->input->post('userfile'),
				'exibir' => $this->input->post('exibir'),
				'descricao' => $this->input->post('descricao')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/podclasse/';
				$config['allowed_types'] = 'mp3|wav';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				//print_r($config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					$this->detalhar(0, $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$podClasse ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			if (!$var['error']) {
				$session_login = $this->session->userdata('login');
				$tituloPodClasse = $this->input->post('titulo');
				$idPodClasse = $this->input->post('id');
				if ($idPodClasse) {
					// Grava o Log 
					$log = "($session_login) [V�DEO] Alterou V�deo do t�tulo ($tituloPodClasse) do id ($idPodClasse) ";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->PodClasseModel->update($idPodClasse, $podClasse);
				} else {
					// Grava o Log 
					$log = "($session_login) [V�DEO] Adicionou V�deo com o titulo ($tituloPodClasse)";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->PodClasseModel->insert($podClasse);
				}
					$this->index();
			}
		}
	}
	
	
	
	function comentario()
	{
		$config = array(
    		'base_url' => site_url('/admin/podCasse/comentario/'),
    		'per_page' => 10,
    		'total_rows' => $this->PodClasseModel->getTotalComentario(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => '�ltima'
    	);
                
        $query = $this->PodClasseModel->exibirComentario($start, $config['per_page']);
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        $var['podComentario'] = $query->result_array();
		$this->load->view('admin/pod_comentario', $var );	
	
	}
	
	function comentarioDetalhar($id)
	{
		if ($id) {
			// Faz o select
			$comentario['row'] = $this->PodClasseModel->comentarioDetalhar($id);
		}
		$this->load->view('admin/podclasse_comentario_manter',$comentario);
	}
	
	
	function comentarioDeletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [COMENT�RIOS PODCLASSE] Deletou Comentario do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->PodClasseModel->comentarioDeletar($id);
		
		$this->comentario();
	}
	
	
	function comentarioManter()
	{

		// Realiza a valida��o dos campos do Form
		$this->form_validation->set_rules ( 'comentario', 'Coment�rio', 'required' );
		
		// Carregar os dados passado atrav�s do formul�rio
		$comentario = array(
			'autorizado' => $this->input->post('autorizado'),
			'comentario' => $this->input->post('comentario'),
		);
		
		// Carrega todos os dados num array para serem editados
		$comentarioPost['row'] = $_POST;
		
		// Ap�s a valida��o dos campos, e dependendo do resultado, � feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/podclasse_comentario_manter',$comentarioPost);
		} else {
			// Edi��o
			$session_login = $this->session->userdata('login');
			$nomeComentario = $this->input->post('comentario');
			$idComentario = $this->input->post('idComentario');
				// Grava o Log 
				$log = "($session_login) [COMENT�RIO PODCASTING] Alterou Coment�rio($nomeComentario) do id ($idComentario)";
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->PodClasseModel->updateComentario($idComentario,$comentario);
			// Adi��o
			if ($this->input->post('autorizado') == "S") {
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Cont�bil - Mensagem Autom�tica - Coment�rio[PODCASTING] Autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu coment�rio[PODCASTING] foi autorizado e est� disposnivel no site.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Cont�bil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta � uma mensagem autom�tica enviada pelo Portal da Classe Cont�bil. N�o responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Cont�bil - Sua solicita��o",$mensagem);
				$this->enviarmail->enviar(); 	
			}	
			$this->comentario();
		}
	}
	
	function opcaoComentario($id,$tipo)
	{
		$session_login = $this->session->userdata('login');
		$autorizado = array ('autorizado' => $tipo );
		$log = "($session_login) [COMENTARIO V�DEOS] Alterou o  coment�rio dos podcasting autoriza��o para ($autorizado) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->PodClasseModel->opcaoComentario($id, $autorizado);
		if ($tipo == "S") {
				$mensagem = "
					----------------------------------------------------------------------------------<br>
					Portal da Classe Cont�bil - Mensagem Autom�tica - Coment�rio[V�DEOS] Autorizado<br>
					----------------------------------------------------------------------------------<br>
					
					Seu coment�rio[V�DEOS] foi autorizado e est� disposnivel no site.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Cont�bil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta � uma mensagem autom�tica enviada pelo Portal da Classe Cont�bil. N�o responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Cont�bil - Sua solicita��o",$mensagem);
				$this->enviarmail->enviar(); 	
			}
		$this->comentario();
	}
	
	
}
?>
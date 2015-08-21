<?php
class Trabalho extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper ( array ('form', 'url', 'date' ) );
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		$this->load->helpers(array('caracteres'));
		// Instânciando as Classe do Model
		$this->load->model ( 'admin/trabalhomodel', "TrabalhoModel" );
		$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		Trabalho::listar($id);
	}
	
	function listar($start = 0) 
	{
			$config = array(
    		'base_url' => site_url('/admin/trabalho/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->TrabalhoModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
                
        $query = $this->TrabalhoModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginação
        $trabalho['pag'] = $this->pagination->create_links();
		
        $trabalho['trabalho'] = $query->result_array();
			$this->load->view('admin/trabalholistar', $trabalho );
	}
	
	

	
	/* Função serve para escolher se o banner será exibido ou não no site.
	*  E também é possivel determinar se o banner abrirá em uma nova janela(_blank) ou não. 
	*  $id: o id do banner no banco de dados
	*  $tipo: Determina se o banner sera exibido no site e/ou nova janela - S(Sim) e N(Não)
	*  $qualCheck: Determina qual o campo da tabela será atualizado
	* */ 
	function opcao($id, $autorizado) 
	{
		// Se for  1 o campo exibir da tabela Banner será atualizado, com o valor preenchido da variável $tipo
		$session_login = $this->session->userdata('login');
		$trabalho = array ('autorizado' => $autorizado );
		$log = "($session_login) [TRABALHO] Alterou o  Trabalho Autorizado para ($autorizado) do id ($id)";
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->TrabalhoModel->opcao($id, $trabalho);
		Trabalho::listar();
	}
	
	function deletar($id) {
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [TRABALHO] Deletou Trabalho do id ($id)";
		$deletar['arquivo'] = $this->TrabalhoModel->detalhar($id);
		$caminho = "/srv/www/dominiosv/classecontabil/html/v3/site/trabalhos/".$deletar['arquivo']['arquivo'];
		//C:/xampp/htdocs/EquipePi/classe/ci/site/trabalhos/
		unlink($caminho);
		$auditoria = array ('log' => $log, 'dataHora' => date ("Y-m-d h:i:s", now ()));
		$this->AuditoriaModel->insert ( $auditoria );
		$this->TrabalhoModel->deletar($id);
		Trabalho::listar();
	}
	
	function detalhar($id=0, $variaveis=false) {
		// Se tiver id, traz o detalhamento do banco
		if ($id) $var['row'] = $this->TrabalhoModel->detalhar($id);
		
		// Se nao tiver id, e tiver retornando um post, passa pra variavel
		if ($variaveis) $var = $variaveis;
		
		$this->load->view('admin/trabalhomanter', $var);
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
		// Validação.
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('resumo', 'resumo', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->detalhar(0, array("row" => $_POST)); // Chama a view de detalhes
		} else {
			// Carrega o array que será inserido no banco
			$trabalho = array(
				'titulo' 		=> $this->input->post('titulo'),
				'resumo' 		=> $this->input->post('resumo'),
				'autor' 		=> nl2br($this->input->post('autor')),
				'orientador' 	=> nl2br($this->input->post('orientador')),
				'tipo' 			=> $this->input->post('tipo'),
				'autorizado' 	=> $this->input->post('autorizado')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$_FILES["userfile"]["name"] = retiraAcentuacao($_FILES["userfile"]["name"]);
				$config['upload_path'] = 'site/trabalhos/';
				$config['allowed_types'] = 'word|pdf|docx';
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
					
					$data ['raw_name'] = retiraAcentuacao($data ['raw_name']);
					
					$trabalho['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			if (!$var['error']) {
				$session_login = $this->session->userdata('login');
				$tituloTrabalho = $this->input->post('titulo');
				$idTrabalho = $this->input->post('id');
				if ($idTrabalho) {
					// Grava o Log 
					$log = "($session_login) [Trabalho] Alterou trabalho do título ($tituloTrabalho) do id ($idTrabalho) ";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->TrabalhoModel->update($idTrabalho, $trabalho);
				} else {
					// Grava o Log 
					$log = "($session_login) [TRABALHO] Adicionou Trabalho com o titulo ($tituloTrabalho)";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->TrabalhoModel->insert($trabalho);
				}
				
				$nomeRementente = $this->input->post('nome');
				if ($this->input->post('autorizado') == "S"){
					$mensagem = "
						----------------------------------------------------------------------------------<br>
						Portal da Classe Contábil - Mensagem Automática - Publicação Autorizado<br>
						----------------------------------------------------------------------------------<br>
						Olá {$nomeRementente},<br><br>
						Sua publicação foi autorizado e está disposnivel no site.<br>
						Acesse: www.classecontabil.com.br/v3/trabalho<br><br>
						
						Atenciosamente,<br>
						
						Equipe do Portal da Classe Contábil
						<br><br>
						------------------------------------------------------------------------------------------<br>
						Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
					";
			
					$this->load->library("enviarmail");
					$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Publicação - Sua solicitação",$mensagem);
					$this->enviarmail->enviar();
				} else if ($this->input->post('autorizado')== "N"){
					$mensagem = "
						----------------------------------------------------------------------------------<br>
						Portal da Classe Contábil - Mensagem Automática - Publicação não autorizado<br>
						----------------------------------------------------------------------------------<br>
						
						Sua publicação não foi autorizado.<br><br>
						
						Atenciosamente,<br>
						
						Equipe do Portal da Classe Contábil
						<br><br>
						------------------------------------------------------------------------------------------<br>
						Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
					";
			
					$this->load->library("enviarmail");
					$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Publicação - Sua solicitação",$mensagem);
					$this->enviarmail->enviar();
				}
				$this->listar ();
			}
		}
	}
}
?>
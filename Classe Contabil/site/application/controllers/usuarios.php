<?php
class Usuarios extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('usuariomodel',"UsuarioModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");

		$this->load->library (array ('form_validation', 'funcoes'));
	}

	function index()
	{
		//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();

		$this->render('login',$var);
	}

	function cadastrar()
	{
		$principal['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$principal['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();

		$this->render('cadastroUsuarios',$var);
	}

	function verificaEmail($email)
	{
		if ($_POST['emailCheck'] != $email){
			$email = $this->UsuarioModel->verificaEmail($email);
			if ($email > 0) {
				$this->form_validation->set_message('verificaEmail', 'E-mail já cadastrado!');
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	function validaArquivo($str)
	{
		global $_FILES, $_POST;

		if ($_FILES['userfile']['name']) {
			return true;
		} elseif ($_POST['id']) {
			// Verifica se já existe uma imagem
			$row = $this->NoticiaModel->verificaImagem($_POST['id']);
			if ($row['avatar'] and file_exists('site/avatar/'.$row['avatar'])) {
				 return true;
			} else {
				$this->form_validation->set_message('validaArquivo', '- Se a opção \'Exibir como Destaque\' foi marcado, é obrigatório o cadastro de uma imagem.<br>');
				return false;
			}
		} else {
			$this->form_validation->set_message('validaArquivo', '- Se a opção \'Exibir como Destaque\' foi marcado, é obrigatório o cadastro de uma imagem.<br> - Utilize o campo \'Ícone destaque\' para cadastrar uma imagem');
			return false;
		}
	}

	function inserirUsuario()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_verificaEmail');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('ocupacao', 'Ocupação', 'required');

		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);

		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;
			$this->render('cadastroUsuarios',$var);
		} else {
			$usuario = array(
				'nome' => $this->input->post('nome'),
				'senha' => md5($this->input->post('senha')),
				'email' => $this->input->post('email'),
				'estado' => $this->input->post('estado'),
				'idOcupacao' => $this->input->post('ocupacao')
			);

			$this->UsuarioModel->insert($usuario);

			$this->index();
		}
	}

	function validar()
	{
		$this->form_validation->set_rules('senha', 'Senha', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE){
			$this->render('login');
		} else {
			$usuario = array(
				'email' => $this->input->post('email'),
				'senha' => md5($this->input->post('senha'))
			);
			$resultado = $this->UsuarioModel->validaLogin($usuario);
			if ($usuario[email] == $resultado[email]){
				$this->UsuarioModel->update($usuario);
				// Logado
				$row = $this->UsuarioModel->validaLogin($usuario);
				$sessionDados = array('nome' => $row['nome'],'email' => $row['email'],'ultimoAcesso' => $row['ultimoAcesso']);
				$this->session->set_userdata($sessionDados);
				redirect('', 'location');
			} else {
				// NÃO Logado

				//Carregar enquete
				$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
				$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();

				$this->render('cadastroUsuarios',$var);
			}
		}
	}

	function meuClasse()
	{
		$idUsuario = $this->session->userdata('idUsuario');
		$emailUsuario = $this->session->userdata('email');;

		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");

		$var['msg'] = $this->session->userdata('msgCadastroConsultor');
		$this->session->unset_userdata('msgCadastroConsultor');

		$var['row'] = $this->UsuarioModel->detalhar($idUsuario);
		$var['artigo'] = $this->exibirFormArtigo($id);
		$var['estados'] = $this->EstadoModel->getAll();
		$var['cargos'] = $this->CargoModel->getAll();
		$var['estado'] = $this->EstadoModel->getOne($idUsuario);
		$var['cargo'] = $this->CargoModel->getOne($idUsuario);
		$var['cidades'] = $this->montarCidades($var['row']['estado'], $var['row']['cidade']);

		//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		//$idUsuario = 987;
		//$email = "hipercontabil.helio@terra.com.br";
		//$idUsuario = 256;
		//$idUsuario = 71916;
		$var['minhasPerguntas'] = $this->UsuarioModel->usuarioPergunta($idUsuario);
		$var['meusComentarios'] = $this->UsuarioModel->usuarioComentarioArtigo($emailUsuario);
		$var['meusArtigos'] = $this->UsuarioModel->meusArtigos($idUsuario);
		$var['consultoria'] = $this->UsuarioModel->consultoria($idUsuario);

		$this->render('meuClasse',$var);
	}

	function montarCidades($estado, $cidade) {
		// Loads
		$this->load->helper('request');
		$this->load->model('cidademodel',"CidadeModel");

		// Monta as cidades
		$var['cidades'] = $this->CidadeModel->getPorEstado($estado);
		$var['cidade'] = $cidade;

		// Renderizacao da view
		$retorno = $this->load->view('cidadesEstado', $var, true);

		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}

	function atualizarDados($idUsuario)
	{
		if ($_POST['senha']){
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
		}
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('ocupacao', 'Ocupação', 'required');

		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;
			$var['artigo'] = $this->exibirFormArtigo($id);
			$var['estados'] = $this->EstadoModel->getAll();
			$var['cargos'] = $this->CargoModel->getAll();
			$var['estado'] = $this->EstadoModel->getOne($idUsuario);
			$var['cargo'] = $this->CargoModel->getOne($idUsuario);
			$var['cidades'] = $this->montarCidades($var['row']['estado'], $var['row']['cidade']);

			$this->render('meuClasse',$var);
		} else {
			$dados = array(
				'nome' => $this->input->post('nome'),
				'estado' => $this->input->post('estado'),
				'idOcupacao' => $this->input->post('ocupacao'),
				'curriculo' => $this->input->post('curriculo')
			);
			if ($_POST['senha']) $dados['senha'] = md5($this->input->post('senha'));

			// Se for passado uma imagem
			if ($_FILES['userfile']['name']) {
				// Cadastra a imagem
				$config['upload_path'] = 'site/avatar';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);

				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var['error'] = $this->upload->display_errors();
					$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
					$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
					$var['estados'] = $this->EstadoModel->getAll();
					$var['cargos'] = $this->CargoModel->getAll();
					$var['estado'] = $this->EstadoModel->getOne($idUsuario);
					$var['cargo'] = $this->CargoModel->getone($idUsuario);

					$this->render('meuClasse', $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$dados['avatar'] = $data ['raw_name'] . $data ['file_ext'];
				}

				// Redimensiona a Imagem
				$resize['image_library'] = 'GD2';
				$resize['source_image'] = 'site/avatar/'.$dados['avatar'];
				$resize['maintain_ratio'] = TRUE;
				$resize['width'] = 80;
				$resize['height'] = 80;

				$this->load->library('image_lib', $resize);
				$this->image_lib->resize();
			}

			$this->UsuarioModel->updateMeuClasse($idUsuario,$dados);
			$meuClasse['row'] = $this->UsuarioModel->detalhar($idUsuario);
			$meuClasse['ok'] = "Dados atualizados com sucesso";
			$meuClasse['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
			$meuClasse['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
			$meuClasse['estados'] = $this->EstadoModel->getAll();
			$meuClasse['cargos'] = $this->CargoModel->getAll();
			$meuClasse['estado'] = $this->EstadoModel->getOne($idUsuario);
			$meuClasse['cargo'] = $this->CargoModel->getone($idUsuario);


		 	 /***********************************
		 	 * Se o Usuário quiser ser consultor
		 	 * *********************************/

			if ($dados['consultor'] == "S"){
		 		// Enviar Email
				$mensagem = "
				----------------------------------------------------------------------------------<br>
				Portal da Classe Contábil - Mensagem pelo site - QUERO SER CONSULTOR<br>
				----------------------------------------------------------------------------------<br>
				Olá Administrador,<br><br>
				<b>{$dados['nome']}</b>, fez uma solicitação para ser Consultor.
				<br>
				<br>---------------------<br>
				Currículo resumido
				<br>---------------------<br>
				{$dados['curriculo']}
				<br><br>

				Para autorizar acesse: <a href=\"http://www.classecontabil.com.br/v3/admin\" target=\"_blank\">www.classecontabil.com.br/v3/admin</a>
				<br><br>
				------------------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";

				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('emailCheck'),"editor@classecontabil.com.br","Solicitação para ser Consultor",$mensagem);
				$this->enviarmail->enviar();
			 	$meuClasse['msg'] = "
			 		Sua solicitação para ser consultor foi enviada com sucesso. Aguarde autorização.<br>
			 	";
			}
		 	$this->render('meuClasse',$meuClasse);
		}
	}
/********************************************************************************************
	Functions responsáveis pelo envio do formulário de Artigo do Meu Classe via ajax
*********************************************************************************************/
	function exibirFormArtigo($idUsuario, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem'	=> "Artigo Cadastrado e Aguadando liberação",
				'id' 		=> $idUsuario,
			);
		}  else {
			$var = array(
				'titulo' 	=> $this->input->post('titulo'),
				'resumo'	=> $this->input->post('resumo'),
				'conteudo'	=> $this->input->post('conteudo'),
				'id' 		=> $idUsuario
			);
		}

		$retorno = $this->load->view('formEnviarArtigo', $var, true);

		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}

	// Realiza o envio do comentário da Notícia
	function enviarArtigo ($idUsuario)
	{
		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules('titulo', 'Titulo do Artigo', 'required');
		$this->form_validation->set_rules('conteudo', 'Artigo', 'required');

		$meuArtigoPost['row'] = $_POST;

		if ($this->form_validation->run() == FALSE){
			$this->exibirFormArtigo($idUsuario);
		} else {
			// Verifica se o usuário é um autor
			$idAutor = $this->UsuarioModel->getAutor($idUsuario);

			$meuArtigo = array(
				'titulo' => $this->input->post('titulo'),
				'resumo' => $this->input->post('resumo'),
				'conteudo' => $this->input->post('conteudo'),
				'data' => date("Y-m-d h:i:s"),
				'idUsuarios' => $idUsuario,
				'idAutores' => $idAutor,
				'bloqueado' => 1
			);

			$this->UsuarioModel->insertMeuArtigo($meuArtigo);
			// Enviar Email
			$mensagem = "
				Olá,<br>
				Foi cadastrado um novo artigo.
				<br><br>
				Para autorizar sua publicação acesse: <a href=\"http://www.classecontabil.com.br/v3/admin\" target=\"_blank\">www.classecontabil.com.br/v3/admin</a>
				<br><br>
				------------------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";

			$this->load->library("enviarmail");
			$this->enviarmail->carregar("lidiannysantiago@grupofortes.com.br","editor@classecontabil.com.br","Novo Artigo",$mensagem);
			$this->enviarmail->enviar();

			$this->exibirFormArtigo($id, "ok");
		}
	}
/********************************************************************************************/

}
?>
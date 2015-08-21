<?php
class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('usuariomodel',"UsuarioModel");
		$this->load->model('consultoresmodel',"ConsultoresModel");
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		$this->load->model('cidademodel',"CidadesModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/temasconsultoriamodel',"TemasConsultoriaModel");

		$this->load->library (array ('form_validation', 'session'));
	}

	function index()
	{
		$this->login();
	}

	function login()
	{
		$this->render('login');
	}

	function cadastrar()
	{
		// Carregar os dados da Editora Fortes no Portal
		$var['estados'] = $this->EstadoModel->getAll();
		$var['cargos'] = $this->CargoModel->getAll();
		$var['temas'] = $this->TemasConsultoriaModel->listar();

		$this->render('cadastroUsuarios', $var);
	}

	function meuClasse($idUsuario)
	{
		// Carregar os dados da Editora Fortes no Portal
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->render('meuClasse',$var);
	}

	function atualizaMeuClasse()
	{
		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);

		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;
			$this->render('meuClasse',$var);
		} else {
			$meuClasse = array(
				'nome' => $this->input->post('nome'),
				'senha' => md5($this->input->post('senha')),
				'email' => $this->input->post('email'),
				'estado' => $this->input->post('estado'),
				'ocupacao' => $this->input->post('ocupacao'),
				'consultor' => $this->input->post('consultor'),
				'curriculo' => $this->input->post('curriculo'),
				'id' => $this->input->post('id')
			);

			$this->UsuarioModel->updateMeuClasse($this->input->post('id'),$meuClasse);

			$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
			$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();

			$this->render('meuClasse',$var);
		}
	}

	function verificaEmail($email)
	{
		$email = $this->UsuarioModel->verificaEmail($email);
		if ($email > 0) {
			$this->form_validation->set_message('verificaEmail', 'E-mail já cadastrado!');
			return false;
		} else {
			return true;
		}
	}

	function inserirUsuario()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_verificaEmail');
		$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('ocupacao', 'Ocupação', 'required');

		$usuario = array(
			'nome' => $this->input->post('nome'),
			'senha' => md5($this->input->post('senha')),
			'email' => $this->input->post('email'),
			'telefone' => $this->input->post('telefone'),
			'estado' => $this->input->post('estado'),
			'cidade' => $this->input->post('cidade'),
			'consultor' => $this->input->post('consultor'),
			'idOcupacao' => $this->input->post('ocupacao'),
			'curriculo' => $this->input->post('curriculo')
		);

		if(!md5($this->input->post('senha'))) unset ($usuario['senha']);

		if ($this->form_validation->run() == FALSE){
			// Retorna os dados do usuario no formulario
			$var['row'] = $_POST;
			$var['estados'] = $this->EstadoModel->getAll();
			$var['cargos'] = $this->CargoModel->getAll();
			$var['temas'] = $this->TemasConsultoriaModel->listar();

			if ($var['row']['estado']) $usuarioPost['cidades'] = $this->montarCidades($var['row']['estado']);

			$this->render('cadastroUsuarios',$var);
		} else {
			$idUsuario = $this->UsuarioModel->insert($usuario);

			// Verifica se o usuário solicitou ser um consultor
			if ($this->input->post('consultor')) {
				// Adiciona para o consultor as suas áreas de atuação.
				$temas = $this->input->post('tema');

				for ($indice=0; $indice < count($temas); $indice++) {
					$tema = $temas[$indice];
					$this->TemasConsultoriaModel->updateTemas($idUsuario, $tema);
				}
			}

			$var['msg'] = "
			Cadastro realizado com sucesso.<br>
			Bem-vido ao maior portal de contabilidade gratuita <br>
			A partir de agora você pode acessar o Portal da Classe Contábil.<br>
			Verifique seu email e leia as informações
			";

			$this->render('login',$var);
		}
	}

	function validar()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('senha', 'Senha', 'required');

		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;
			$this->render('login',$var);
		} else {
			$usuario = array(
				'email' => $this->input->post('email'),
				'senha' => md5($this->input->post('senha'))
			);

			$row = $this->UsuarioModel->validaLogin($usuario);

			if ($usuario['email'] == $row['email']){

				// Armazena os dados na sessão
				$sessionDados = array(
					'nome' 			=> $row['nome'],
					'email' 		=> $row['email'],
					'ultimoAcesso' 	=> $row['ultimoAcesso'],
					'consultor' 	=> $row['consultor'],
					'autorizado' 	=> $row['autorizado'],
					'avatar' 		=> $row['avatar'],
					'idUsuario' 	=> $row['id']
				);
				$this->session->set_userdata($sessionDados);

				// Redireciona o usuário
				if ($this->input->post('backTo')) {
					$backTo = $this->input->post('backTo');
				} else {
					$backTo = $this->session->userdata('backTo');
					$this->session->unset_userdata('backTo');
				}
				redirect($backTo, 'location');
			} else {
				// NÃO Logado
				$var['erro'] = "Login ou senha incorretos";
				$this->render('login', $var);
			}
		}
	}

	// Redireciona o usuário para ele preencher seu email para receber sua senha.
	function esqueciMinhaSenha()
	{
		$this->render('esqueciMinhaSenha');
	}

	// Envia a senha para o email informado.
	function enviarSenha()
	{
		$this->load->library("enviarmail");
		// Verifica se o usuário existe
		$rowUsuario	= $this->UsuarioModel->retornaSenha($this->input->post('email'));
		$rowConsultor = $this->ConsultoresModel->retornaSenha($this->input->post('email'));

		if ($rowUsuario) {
			/// Texto que gera uma nova senha
			//$texto = "classe";
			//$novaSenha = base64_encode($texto);
			$novaSenha = rand(000000,999999);
			// Insere a nova senha gerada para o usuario
			$this->UsuarioModel->updateSenha($this->input->post('email'), $novaSenha);

			$mensagem = "
				-------------------------------------------------------------------------<br>
				Portal da Classe Contábil - Mensagem pelo site - ESQUECI MINHA SENHA<br>
				-------------------------------------------------------------------------<br>
				Olá,<br>
				Sua senha nova é:&nbsp;&nbsp;<b>$novaSenha</b>
				<br><br>
				----------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";

			$this->enviarmail->carregar($_POST['email'],"editor@classecontabil.com.br","Esqueci minha senha",$mensagem);
			$this->enviarmail->enviar();

			$var['msg'] = "Senha enviada com sucesso para <b>".$_POST['email']."</b>";
			$var['email'] = $_POST['email'];
    		$this->render('login', $var);
		} else if ($rowConsultor) {
			$novaSenha = rand(000000,999999);
			// Insere a nova senha gerada para o consultor
			$this->ConsultoresModel->updateSenha($this->input->post('email'), $novaSenha);

			$mensagem = "
				-------------------------------------------------------------------------<br>
				Portal da Classe Contábil - Mensagem pelo site - ESQUECI MINHA SENHA<br>
				-------------------------------------------------------------------------<br>
				Olá,<br>
				Sua senha nova é:&nbsp;&nbsp;<b>$novaSenha</b>
				<br><br>
				----------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";

			$this->enviarmail->carregar($_POST['email'],"editor@classecontabil.com.br","Esqueci minha senha",$mensagem);
			$this->enviarmail->enviar();

			$var['msg'] = "Senha enviada com sucesso para <b>".$_POST['email']."</b>";
			$var['email'] = $_POST['email'];

    		$this->render('login', $var);
		} else  {
		    $var['msg'] = "Email inválido, por favor digite novamente";
		    $this->render('esqueciMinhaSenha', $var);
		}
	}

	// Guarda a data do acesso e encerra a session do Usuário.
	function logout ()
	{
		$idUsuario = $this->session->userdata('idUsuario');
		$this->UsuarioModel->update($idUsuario);
		$this->session->destroy();
		redirect('', 'location');
	}

############################### Área do Consultor ###########################################################################

	function verificaEmailConsultor($email)
	{
		$email = $this->ConsultoresModel->verificaEmail($email);
		if ($email > 0) {
			$this->form_validation->set_message('verificaEmailConsultor', 'E-mail já cadastrado!');
			return false;
		} else {
			return true;
		}
	}

	function inserirConsultor()
	{
		$idUsuario = $this->session->userdata('idUsuario');

		// Muda o status do usuário
		$dados = array (
			"consultor" => 1,
			'curriculo' => $this->input->post('curriculo')
		);

		$this->UsuarioModel->updateMeuClasse($idUsuario, $dados);

		// Adiciona para o consultor as suas áreas de atuação.
		$temas = $this->input->post('tema');

		// Muda a sessao de identificacao do usuário
		$sessionDados['consultor'] = 1;
		$this->session->set_userdata($sessionDados);

		for ($indice=0; $indice < count($temas); $indice++) {
			$tema = $temas[$indice];
			$this->TemasConsultoriaModel->updateTemas($idUsuario, $tema);
		}

		$sessionDados['msgCadastroConsultor'] = "
		Cadastro realizado com sucesso.<br><br>
		Bem-vindo ao maior portal de contabilidade.<br>
		A partir de agora você pode acessar o Portal da Classe Contábil.<br><br>
		Verifique seu email e leia as informações<br><br>";

		$this->session->set_userdata($sessionDados);

		redirect('/usuarios/meuClasse/');
	}

	function cadastrarConsultor()
	{
		if ($this->session->userdata('consultor') > 0) {
			switch ($this->session->userdata('consultor')) {
				case 1:
					$sessionDados['msgCadastroConsultor'] = "
					Seu currículo já está sendo avaliado. <br> Por favor, aguarde.
					";
					break;

				case 2:
					$sessionDados['msgCadastroConsultor'] = "
					Você já é um consultor
					";
					break;
			}

			$this->session->set_userdata($sessionDados);

			redirect('/usuarios/meuClasse/');
		}

		$var['estados'] = $this->EstadoModel->getAll();
		$var['temas'] = $this->TemasConsultoriaModel->listar();

		$this->render('cadastroConsultor', $var);
	}

	function montarCidades($estado) {
		// Loads
		$this->load->helper('request');
		$this->load->model('cidademodel',"CidadeModel");

		// Monta as cidades
		$var['cidades'] = $this->CidadeModel->getPorEstado($estado);
		$var['cidade'] = $this->input->post('cidade');

		// Renderizacao da view
		$retorno = $this->load->view('cidadesEstado', $var, true);

		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}

	// Guarda a data do acesso e encerra a session do Consultor.
	function logoutConsultor ()
	{
		$idUsuario = $this->session->userdata('idUsuario');
		$this->ConsultoresModel->update($idUsuario);
		$this->session->destroy();
		redirect('', 'location');
	}
}
?>
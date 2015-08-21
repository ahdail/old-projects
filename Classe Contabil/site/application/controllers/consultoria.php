<?php
class Consultoria extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('consultoriamodel',"ConsultoriaModel");

		$this->load->library(array('form_validation', 'funcoes', 'enviarmail', 'pagination'));
		$this->load->helper(array('highlight', 'string', 'login', 'tag_dicionario'));
	}

	function index($idTema = 0, $start = 0)
	{
		// Verifica se o usuario fez uma busca por chave ou se esta paginando um filtro de chave
		if ($this->input->post('chave')) {
			$chave = $this->input->post('chave');
			$this->session->set_userdata(array("chaveBuscaConsultoria" => $chave));
			$idTema = -1;
		} else if ($this->session->userdata('chaveBuscaConsultoria') && $idTema == -1) {
			$chave = $this->session->userdata('chaveBuscaConsultoria');
		}

		$num = $this->input->post('num');

		// Pre configura o array de paginacao
		$config = array(
    		'base_url' 		=> site_url("/consultoria/index/{$idTema}/"),
    		'per_page' 		=> 10,
    		'uri_segment' 	=> 4,
	    	'num_links' 	=> 9,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);

		// Monta as perguntas de acordo com o filtro
		if ($chave) {
			$var['total'] =  $this->ConsultoriaModel->getTotal($chave, 2);
			$var['perguntas'] = $this->ConsultoriaModel->buscarChave($chave, $start, $config['per_page']);
			$var['chave'] = $chave;
		} else if ($num){
	        $var['perguntas'] = $this->ConsultoriaModel->buscarNum($num);
	        $var['num'] = $num;
		} else if ($idTema > 0) {
			$var['total'] =  $this->ConsultoriaModel->getTotal($idTema, 1);
			$var['perguntas'] = $this->ConsultoriaModel->filtrarTema($idTema, $start, $config['per_page']);
			$var['id'] = $idTema;
		} else {
			$var['total'] =  $this->ConsultoriaModel->getTotal();
			$var['perguntas'] = $this->ConsultoriaModel->ultimasPerguntas($start, $config['per_page']);
		}

		// Caso haja o total de registros, cria a paginacao
		if ($var['total']) {
			// Complementa a configuracao da paginacao
			$config['total_rows'] = $var['total'];
			// Inicia a paginacao e cria os links
			$this->pagination->initialize($config);
        	$var['pag'] = $this->pagination->create_links();
		}
		// calcula a quantidade de página.
		if($start == 0){
			$var['qtd'] = $config['per_page'];
		}else{
			$var['qtd'] = $start + $config['per_page'];
		}

		$var['temas'] = $this->ConsultoriaModel->temas();
		$this->render('consultoria', $var);
	}

	function buscar()
	{
		$chave = $this->input->post('chave');
		$num = $this->input->post('num');

		if ($chave) {
			$var['busca'] = $this->ConsultoriaModel->buscarChave($chave);
		} else if ($num){
	        $var['busca'] = $this->ConsultoriaModel->buscarNum($num);
		}

		$this->render('consultoria', $var);
	}

	function ver($id)
	{
		$var['pergunta'] = $this->ConsultoriaModel->ver($id);
		$var['respostas'] = $this->ConsultoriaModel->verRespostas($id);
		//Verificar avatar do cara.
		$var['avatar'] = $this->ConsultoriaModel->verificaAvatar($id);

		$var['id'] = $id;
		$this->render('consultoriaRespostas', $var);
	}

	function filtrarTema($id)
	{
		$var['pergunta'] = $this->ConsultoriaModel->filtrarTema($id);
		$var['temas'] = $this->ConsultoriaModel->temas();
		$var['id'] = $id;
		$this->render('consultoria', $var);
	}

	function perguntar()
	{
		$this->form_validation->set_rules('idTema', 'Tema', 'required');
		$this->form_validation->set_rules('pergunta', 'pergunta', 'required');

		$perguntaPost['row'] = $_POST;

		if ($this->form_validation->run() == FALSE){
			Consultoria::index();
		} else {
			$perguntaSemHtml = htmlspecialchars($this->input->post('pergunta'));
			$pergunta = array(
				'idUsuario' 	=> $this->input->post('idUsuario'),	// mudar e pegar da sessão
				'nome' 			=> $this->input->post('nome'),		// mudar e pegar da sessão
				'idTema' 		=> $this->input->post('idTema'),
				'data' 			=> date ("Y-m-d H:i:s"),
				'pergunta' 		=> $perguntaSemHtml
			);
			// Envia email informando o recebimento da mensagem.
			$idPergunta = $this->ConsultoriaModel->perguntar($pergunta);

			$mensagem = "
				----------------------------------------------------------------------------------<br>
				Portal da Classe Contábil - Mensagem pelo site - Consultoria Gratuita<br>
				----------------------------------------------------------------------------------<br>
				Prezado(a) senhor(a) <b>{$pergunta['nome']}</b>,<br><br>

				Sua Pergunta de id <b>{$idPergunta}</b> foi cadastrada.<br> Aguarde, em breve ela será respondida por nossos consultores.<br><br>

				Atenciosamente,<br>

				Equipe do Portal da Classe Contábil
				<br><br>
				------------------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";

			$this->load->library("enviarmail");
			$this->enviarmail->carregar($this->input->post('email'),"editor@classecontabil.com.br","Consultoria Gratuita - Pergunta",$mensagem);
			$this->enviarmail->enviar();


			redirect('consultoria', 'location');
		}
	}

	function responder($id)
	{
		$this->form_validation->set_rules('resposta', 'Resposta', 'required');

		$respostaPost['row'] = $_POST;

		if ($this->form_validation->run() == FALSE){
			$this->load->view('consultoriaRespostas', $respostaPost);
		} else {
			$respostaSemHtml = htmlspecialchars($this->input->post('resposta'));
			$resposta = array(
				'idPergunta' 	=> $id,
				'idUsuario' 	=> $this->input->post('idUsuario'),
				'data' 			=> date ("Y-m-d H:i:s"),
				'resposta' 		=> $respostaSemHtml
			);

			$row = $this->ConsultoriaModel->mandarEmail($id);
			$var['pergunta'] = $this->ConsultoriaModel->ver($id);
			$var['respostas'] = $this->ConsultoriaModel->verRespostas($id);
			$var['id'] = $id;

			// Envia email informando o recebimento da mensagem.
			$mensagem = "
				----------------------------------------------------------------------------------<br>
				Portal da Classe Contábil - Mensagem pelo site - Consultoria Gratuita<br>
				----------------------------------------------------------------------------------<br>
				Prezado(a) senhor(a) <b>{$row[0]['nome']}</b>,<br><br>

				A sua pergunta de id <b>{$id}</b> , feita na consultoria gratuita do portal, foi respondida
				<br><br>
				Atenciosamente,<br>

				Equipe do Portal da Classe Contábil
				<br><br>
				------------------------------------------------------------------------------------------<br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";

			$this->load->library("enviarmail");
			$this->enviarmail->carregar($row[0]['email'],"editor@classecontabil.com.br","Consultoria Gratuita - Resposta",$mensagem);
			$this->enviarmail->enviar();

			$this->ConsultoriaModel->responder($resposta);

			// Carregar os dados da Editora Fortes no Portal

			$this->render('consultoriaRespostas', $var);
		}
	}

	function verResposta($id)
	{
		$var['pergunta'] = $this->ConsultoriaModel->ver($id);

		$this->render('consultoriaRespostas', $var);
	}

}
?>
<?php
class Consultoria extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array('form_validation', 'session', 'pagination', 'auditoria'));
		$this->load->
		model('consultoriamodel',"ConsultoriaModel");
	}
	function index()
	{
		$this->load->view('admin/consultoriaperguntaslistar');
	}

	function perguntas()
	{
		$config = array(
		    'base_url' 		=> site_url('/admin/consultoria/perguntas/'),
		    'per_page' 		=> 20,
		    'total_rows'	=> $this->ConsultoriaModel->getTotal(),
		    'uri_segment' 	=> 4,
		    'first_link' 	=> 'Primeira',
		    'last_link' 	=> '�ltima'
    	);
    	$query = $this->ConsultoriaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $consultoria['pag'] = $this->pagination->create_links();
        $consultoria['perguntas'] = $query->result_array();
        $consultoria['temas'] = $this->ConsultoriaModel->temas();
		$this->load->view('admin/consultoriaperguntaslistar', $consultoria);
	}

	function filtrarTema($id)
	{
		$perguntas['pergunta'] = $this->ConsultoriaModel->filtrarTema($id);
		$perguntas['temas'] = $this->ConsultoriaModel->temas();
		$perguntas['id'] = $id;
		$perguntas['filtro'] = true;
		$this->load->view('admin/consultoriaperguntaslistar', $perguntas);
	}


	function detalhar($id = 0)
	{
		if ($id) {
	       	$consultoresClasse['row'] = $this->ConsultoresClasseModel->detalhar($id);
		}
		$consultoresClasse['estados'] = $this->EstadoModel->getAll();
		$consultoresClasse['cidades'] = $this->CidadeModel->getAll();
		$consultoresClasse['cargos'] = $this->CargoModel->getAll();
		$this->load->view('admin/consultoresclassemanter', $consultoresClasse);
	}

	function deletar($id)
	{
		// Grava o Log
		$usuarioClasse['row'] = $this->ConsultoresClasseModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $usuarioClasse['row']['nome'], $usuarioClasse['row']['id'], "Excluiu [MEU CLASSE - Usu�rio]");
		$this->auditoria->gravar();

		$this->ConsultoresClasseModel->deletar($id);
		ConsultoresClasse::listar();
	}

	function manter()
	{
		// Valida��o.
		$this->form_validation->set_rules('email', 'Login', 'required');

		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('idOcupacao', 'Ocupa��o', 'required');

		// Carregar os dados passado atrav�s do formul�rio
		$consultoresClasse = array(
			'nome' 			=> $this->input->post('nome'),
			'email' 		=> $this->input->post('email'),
			'estado' 		=> $this->input->post('estado'),
			'idOcupacao' 	=> $this->input->post('idOcupacao'),
			'curriculo' 	=> $this->input->post('curriculo'),
			'autorizado' 	=> $this->input->post('autorizado')
		);

		//print_r($usuarioClasse);
		//die();


		$consultoresClassePost['estados'] = $this->EstadoModel->getAll();
		$consultoresClassePost['cargos'] = $this->CargoModel->getAll();
		$consultoresClassePost['row'] = $_POST;

		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/consultoresclassemanter',$consultoresClassePost);

		} else {
			$idUsuario = $this->input->post('id');
			$nomeUsuario = $this->input->post('nome');
			$session_login = $this->session->userdata('login');
			if($idUsuario){//Edita
				// Grava Log
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Editou [MEU CLASSE - Usu�rio]");
				$this->auditoria->gravar();

				$this->ConsultoresClasseModel->update($idUsuario, $consultoresClasse);
			} else {//Adiciona
				// Grava o Log
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Adicionou [MEU CLASSE - Usu�rio]");
				$this->auditoria->gravar();


				$this->ConsultoresClasseModel->insert($consultoresClasse);

			}
				/*if ($usuarioClasse['autorizado'] == "S"){
			 		// Enviar Email
					$mensagem = "
						----------------------------------------------------------------------------------<br>
						Portal da Classe Cont�bil - Mensagem pelo site - Consultor Autorizado<br>
						----------------------------------------------------------------------------------<br>
						Ol� <b>{$usuarioClasse['nome']}</b>,<br><br>

						A sua solicita��o para integrar o quadro de consultores do Portal da Classe Cont�bil foi aceita.<br>

						A partir de agora, voc� j� pode responder �s d�vidas dos usu�rios acessando o menu
						<b>Consultoria Gratuita</b> no <a href=\"http://www.classecontabil.com.br/v3/consultoria\" target=\"_blank\">Portal da Classe Cont�bil</a><br><br>

						Atenciosamente,<br>

						Equipe do Portal da Classe Cont�bil
						<br><br>
						------------------------------------------------------------------------------------------<br>
						Esta � uma mensagem autom�tica enviada pelo Portal da Classe Cont�bil. N�o responda!
					";

					$this->load->library("enviarmail");
					$this->enviarmail->carregar($usuarioClasse['email'],"classecontabil@classecontabil.com.br","Consultor Autorizado",$mensagem);
					$this->enviarmail->enviar();
				}*/
			ConsultoresClasse::listar();
		}
	}
}
?>
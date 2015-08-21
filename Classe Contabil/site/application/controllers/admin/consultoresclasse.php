<?php
class Consultoresclasse extends Controller {

	function __construct() 
	{
		parent::Controller();
			
		// Carregar aos Helpers de Form, URL e DATE e as Library de valida��o
		$this->load->helper(array('form', 'url','date','data', 'highlight', 'string'));
		$this->load->helpers(array('data', 'login', 'tag_dicionario'));
		$this->load->library(array('form_validation', 'session', 'pagination', 'auditoria'));
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		$this->load->model('cidademodel',"CidadeModel");
		$this->load->model('admin/temasconsultoriamodel',"TemasConsultoriaModel");
		$this->load->model('admin/consultoresclassemodel',"ConsultoresClasseModel");
	}
	
	function index($filtro=1, $start=0){
		$this->input->post('filtro');
		echo "<br>";
		
		$config = array(
		    'base_url' 		=> site_url("admin/consultoresclasse/index/{$filtro}/"),
		    'per_page' 		=> 18,
		    'uri_segment' 	=> 4,
			'num_links' 	=> 19,
		    'first_link' 	=> 'Primeira',
		    'last_link' 	=> '�ltima'
    	);
		
		if ($filtro == 1) {
			$consultoresClasse['total'] =  $this->ConsultoresClasseModel->getTotal($filtro, 1);
			$consultoresClasse['consultores'] = $this->ConsultoresClasseModel->exibirAguardando($filtro, $start, $config['per_page']);
		} else if ($filtro == 2){
	       	$consultoresClasse['total'] =  $this->ConsultoresClasseModel->getTotal($filtro, 2);
			$consultoresClasse['consultores'] = $this->ConsultoresClasseModel->exibirAutorizado($filtro, $start, $config['per_page']);
		} 
		
		if ($consultoresClasse['total']) {
			// Complementa a configuracao da paginacao
			$config['total_rows'] = $consultoresClasse['total'];
			// Inicia a paginacao e cria os links
			$this->pagination->initialize($config);
        	$consultoresClasse['pag'] = $this->pagination->create_links();
		}
		$consultoresClasse['filtro'] = $filtro;
		$consultoresClasse['temas'] = $this->ConsultoresClasseModel->temas();
		$this->load->view('admin/consultoresclasselistar', $consultoresClasse);
		
		/*if($filtro == 0){
			echo "N�o autorizado";
			$this->listar();
		}else if($filtro == 1){
			echo "Aguradando";
		}else if ($filtro == 2){
			echo "Autorizado";
		}*/
		//die();
	}
	
	function buscar() 
	{	
		$search = $this->input->post('search');
	    $consultor['consultores'] = $this->ConsultoresClasseModel->buscarConsultor($search);
	    //print_r($consultor['consultores']);
	    //die();
	    $this->load->view('admin/consultoresclasselistar', $consultor);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
	       	$var['row'] = $this->ConsultoresClasseModel->detalhar($id);
	       	$var['cidades'] = $this->montarCidades($var['row']['estado'], $var['row']['cidade']);
		} 
		$var['estados'] = $this->EstadoModel->getAll();
		$var['cargos'] = $this->CargoModel->getAll(); 
		$var['temas'] = $this->TemasConsultoriaModel->temas();
		$var['temasConsultor'] = $this->TemasConsultoriaModel->temasConsultor($id);

		$this->load->view('admin/consultoresclassemanter', $var);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$usuarioClasse['row'] = $this->ConsultoresClasseModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $usuarioClasse['row']['nome'], $usuarioClasse['row']['id'], "Excluiu [MEU CLASSE - Usu�rio]");
		$this->auditoria->gravar();
		
		$this->ConsultoresClasseModel->deletar($id);
		ConsultoresClasse::index();
	}
	
	function montarCidades($estado, $cidade=false) {
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
			'senha' 		=> md5($this->input->post('senha')),
			'telefone' 		=> $this->input->post('fone'),
			'estado' 		=> $this->input->post('estado'),
			'cidade' 		=> $this->input->post('cidade'),
			'idOcupacao' 	=> $this->input->post('idOcupacao'),
			'curriculo' 	=> $this->input->post('curriculo'),
			'consultor' 	=> $this->input->post('consultor')
		);
		
		
		
		/*$indice = $this->input->post('idSecao2');
		$perfil = array('perfil' => $this->input->post('perfil'));*/
		
		if ($this->form_validation->run() == FALSE){
			$var['estados'] = $this->EstadoModel->getAll();
			$var['cargos'] = $this->CargoModel->getAll();
			$var['temas'] = $this->TemasConsultoriaModel->listar(); 
			$var['row'] = $_POST;
			
			if ($var['row']['estado']) {
				$var['cidades'] = $this->montarCidades($var['row']['estado'], $consultoresClasse['cidade']);
			}
		
			$this->load->view('admin/consultoresclassemanter',$var);
		
		} else {
			$idUsuario = $this->input->post('id');
			$nomeUsuario = $this->input->post('nome');
			$session_login = $this->session->userdata('login');
			$temas = $this->input->post('tema');
			if($idUsuario){//Edita
				// Deleta.
				$this->TemasConsultoriaModel->deletaTemas($idUsuario, $tema);
				// Adiciona para o consultor as suas �reas de atua��o.
				for ($indice=0; $indice < count($temas); $indice++) {
					$tema = $temas[$indice];
					$this->TemasConsultoriaModel->updateTemas($idUsuario, $tema);
				}
				// Grava Log
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Editou [MEU CLASSE - Usu�rio]");
				$this->auditoria->gravar();
				
				$this->ConsultoresClasseModel->update($idUsuario, $consultoresClasse);
			} else {//Adiciona
				// Adiciona para o consultor as suas �reas de atua��o.
				for ($indice=0; $indice < count($temas); $indice++) {
					$tema = $temas[$indice];
					$this->TemasConsultoriaModel->updateTemas($idUsuario, $tema);
				}
				// Grava o Log 
				$this->auditoria->carregar($session_login, $nomeUsuario, $idUsuario, "Adicionou [MEU CLASSE - Usu�rio]");
				$this->auditoria->gravar();
				
				print_r($consultoresClasse);
				//die();
				
				$this->ConsultoresClasseModel->insert($consultoresClasse);
			
			}
			
			// Adiciona para o consultor as suas �reas de atua��o.
			
			
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
			ConsultoresClasse::index();
		}		
	}
	
	
}
?>
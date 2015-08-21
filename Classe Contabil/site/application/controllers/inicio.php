<?php
class Inicio extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuariomodel',"UsuarioModel");
		$this->load->model('videomodel',"VideoModel");
		$this->load->model('podmodel',"PodModel");	
		$this->load->model('noticiaModel',"NoticiaModel");
		$this->load->model('artigoModel',"ArtigoModel");
		$this->load->model('juizodiariomodel',"JuizoDiarioModel");
		$this->load->model('admin/eventomodel',"EventoModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/dicasmodel',"DicasModel");
		$this->load->model('admin/depoimentosmodel',"DepoimentosModel");
		
		$this->load->library(array('form_validation', 'funcoes'));
        $this->load->helper(array('tag_dicionario', 'login'));
	}
	
	function exibirFormDepoimento($status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array('mensagem'	=> "Depoimento enviado. Aguarde liberação");	
		}  else {
			$var = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'depoimento'	=> $this->input->post('depoimento'),
				'autorizado'	=> "A"
			);	
		}
		
		$retorno = $this->load->view('depoimentosForm',$var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	function enviarDepoimento()
	{
		// Realiza a validaï¿½ï¿½o dos compos do Form
		$this->form_validation->set_rules('depoimento', 'Depoimento', 'required');
		
    	if ($this->form_validation->run() == FALSE){
			$this->exibirFormDepoimento($status = "");
		} else {
			$depoimentos = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'depoimento'	=> $this->input->post('depoimento'),
				'autorizado'	=> "A"
			);
			$mensagem = "
				Olá,<br>
				Foi Enviada novo Depoimento pelo site da Classe Contábil.
				<br><br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar("editor@classecontabil.com.br", $depoimentos['email'],"Classe Contábil - Novo Depoimento",$mensagem);
			$this->enviarmail->enviar();
			
			$this->DepoimentosModel->insert($depoimentos);
		
			$this->exibirFormDepoimento("ok");
		}
	}
	
	
	function index($showDepoimento = false)
	{
		$var['showDepoimento'] = $showDepoimento;
		
		$var['noticiaDestaque'] = $this->NoticiaModel->exibirDestaque();
		$var['noticiasPrincipais'] = $this->NoticiaModel->exibirPrincipal();
		$var['noticiaAcessos'] = $this->NoticiaModel->maisAcessados();
		// Carregar os Artigos
		$var['artigoDestaque'] = $this->ArtigoModel->exibirDestaque();
		$var['artigosPrincipais'] = $this->ArtigoModel->exibirPrincipal();
		$var['artigoAcessos'] = $this->ArtigoModel->maisAcessados();
		// Carregar o Juï¿½zo Diï¿½rio
		$var['juizoDiario'] = $this->JuizoDiarioModel->exibirJuizoDiarioDestaque();
		// Carregar o Direito Empresarial
		$var['direitoDestaque'] = $this->ArtigoModel->exibirDireitoDestaque();
		//Carregar os vídeos
		$var['video'] = $this->VideoModel->exibirVideo();
		$var['videoDestaque'] = $this->VideoModel->exibirVideoDestaque();
		$var['videoAcessados'] = $this->VideoModel->maisAcessados();
		//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		// Carregar o Dicas Do Portal
		$var['dicasPortal'] = $this->DicasModel->exibirDicasPortal();
		// Carregar o Depoimentos Do Portal
		$var['depoimentosPortal'] = $this->DepoimentosModel->exibirDepoimentosPortal();
		$var['depoimentosPortalMax'] = $this->DepoimentosModel->getMax();
		$var['depoimentoForm'] = $this->exibirFormDepoimento();
		
		$this->render('index',$var);
	}
	
}
?>
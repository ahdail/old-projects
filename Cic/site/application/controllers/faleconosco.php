<?php
class Faleconosco extends Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('enviarmail', 'form_validation'));
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->model('faleconosco_model',"falemodel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}
	
	function index()
	{
		$this->exibir();
	}
	
	function exibir($form=false)
	{
		$var['funcoes'] = $this->falemodel->funcaoListarTodos();
		// Retorno do formulário em caso de erros na validação
		$var['form'] = $form;
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('faleconosco', $var);	
	}
	
	function enviar() {
		$this->form_validation->set_rules('para', 'Falar com', 'required');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('assunto', 'Assunto', 'required');
		$this->form_validation->set_rules('msg', 'Mensagem', 'required');
		
		if ($this->form_validation->run () == FALSE) {
			$this->exibir($_POST);
			return;
		} else {
			$para = $this->input->post('para');
			$remetente = $this->input->post('email');
			$assunto = $this->input->post('assunto');
			$mensagem = "
			<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
			<strong>NOME:</strong> <br>
			{$this->input->post('nome')}
			<br><br>
			<strong>MENSAGEM:</strong> <br>
			".nl2br($this->input->post('msg'))."
			</span>
			";
			
			$this->enviarmail->carregar($para,$remetente,$assunto,$mensagem);
			$this->enviarmail->enviar();
			
			$this->exibir(array('sucesso' => 'Mensagem enviada com sucesso!'));
		}
	}
}
?>
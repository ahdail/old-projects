<?php
class Anuncie extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('modelomodel', "ModeloModel");
		
		$this->load->library(array ('form_validation', 'funcoes'));
		
	}

	function index() 
	{
		$var['modelo'] = $this->ModeloModel->exibirAnuncie();
		$this->render('anuncieForm', $var);
	}
	
	function enviar()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;
			$this->render('anuncieForm', $var);
		} else {
			$msg['msg'] = "Mensagem enviada com sucesso (Anuncie)...";
			
			// Envia email informando o recebimento da mensagem.
			$this->load->library("enviarmail");
			$mensagem = "
			Ol�,<br>
			Foi Enviada uma mensagem (Fale Conosco )pelo site da Classe Cont�bil.
			<br><br>
			Esta � uma mensagem autom�tica enviada pelo Portal da Classe Cont�bil. N�o responda!";
			
			$this->enviarmail->carregar($_POST['email'],"editor@classecontabil.com.br","Fale Conosco",$mensagem);
			$this->enviarmail->enviar();    				
			
			$this->render('anuncieForm', $msg);
		} 
	}
	
}
?>
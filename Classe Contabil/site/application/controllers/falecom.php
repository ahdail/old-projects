<?php
class FaleCom extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation', 'funcoes','enviarmail','session'));
	}

	function index()
	{
		$this->render('falecomForm');
	}

	function enviar()
	{
		$this->form_validation->set_rules('nome_contato', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('fone_contato', 'Fone para Contato', 'required');
		$this->form_validation->set_rules('mensagem', 'Mensagem', 'required');

		if ($this->form_validation->run() == FALSE){
			$var['row'] = $_POST;			
			$this->load->view('contato', $var);
		} else {
			$contato = array(
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'fone_contato' 	=> $this->input->post('fone_contato'),
				'mensagem' 	=> $this->input->post('mensagem')
			);

			$var['msg'] = "Mensagem enviada com sucesso.";

			if ($var['msg']){
				// Envia email informando o recebimento da mensagem.
				$this->load->library("enviarmail");
				$mensagem = "
				-------------------------------------------------------------------------<br>
				Site - Contract Construtora - Mensagem pelo site - CONTATO<br>
				-------------------------------------------------------------------------<br>
				Olá ,<br><br>
				<b>{$contato['nome_contato']}</b> entrou em contato através do página contato do site da Contract Construtora e enviou a seguinte mensagem:
				<br>---------------------<br>
				MENSAGEM
				<br>---------------------<br>
				<i>{$contato['mensagem']}</i>
				<br><br>
				Esta é uma mensagem automática enviada pelo site Contract Construtora. Não responda!";

				$this->enviarmail->carregar("ahdail@gmail.com",$this->input->post('email'),"Contato",$mensagem);
				$this->enviarmail->enviar();
			}

			$this->load->view('contato', $var);
		}
	}

}
?>
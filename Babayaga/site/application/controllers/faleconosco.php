<?php
class FaleConosco extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session','enviarmail', 'form_validation'));
		$this->load->model('admin/ondeestamosmodel',"OndeEstamosModel");
		$this->load->model('admin/faleconoscomodel',"FaleConoscoModel");
	}
	function index() 
	{
		$var['row'] = $this->OndeEstamosModel->exibirSite();
		$var['felecom'] = $this->FaleConoscoModel->exibirSite();
	
		$this->load->view('faleconosco', $var);
	}
	
	function enviar()
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.gmail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'ahdail@gmail.com',
		  'smtp_pass' => '@031281@',
		  'smtp_timeout' => 30);
		 
		$config['mailtype'] = "html";
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
	
		$this->load->library('email', $config);

		
		
		$this->email->from('voce@seu-site.com', 'Seu Nome');
		$this->email->to('ahdail@gmail.com');
		//$this->email->cc('outro@outro-site.com');
		//$this->email->bcc('fulano@qualquer-site.com');

		$this->email->subject('Teste de Email');
		$this->email->message('Testando a classe de email.');

		$this->email->send();

		echo $this->email->print_debugger();

	}
	
	
	function novo() {
		//$this->form_validation->set_rules('para', 'Falar com', 'required');
		$this->form_validation->set_rules('nomeremetente', 'Nome', 'required');
		$this->form_validation->set_rules('emailremetente', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('telefoneremetente', 'Telefone', 'required');
		$this->form_validation->set_rules('assuntoremetente', 'Assunto', 'required');
		$this->form_validation->set_rules('mensagemremetente', 'Mensagem', 'required');
		
		$faleConoscoPost['row'] = $_POST;
		
		if ($this->form_validation->run () == FALSE) {
			$faleConoscoPost['row'] = $this->OndeEstamosModel->exibirSite();
			$faleConoscoPost['felecom'] = $this->FaleConoscoModel->exibirSite();
			$this->load->view('faleconosco', $faleConoscoPost);
		} else {
			$para = "ahdail@gmail.com";//$this->input->post('para');
			$remetente = "ahdail@gmail.com";//$this->input->post('email');
			$assunto = $this->input->post('assunto');
			$mensagem = "
				<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
				<strong>NOME:</strong>
				{$this->input->post('nomeremetente')}
				<br>
				<strong>E-MAIL:</strong>
				{$this->input->post('emailremetente')}
				<br>
				<strong>TELEFONE:</strong>
				{$this->input->post('telefoneremetente')}
				<br>
				<strong>ASSUNTO:</strong>				
				{$this->input->post('assuntoremetente')}
				<br><br>
				<strong>MENSAGEM:</strong> <br>
				".nl2br($this->input->post('mensagemremetente'))."
				
				<br><br><br>
				:: Enviado através do site babayaga.com.br ::
				</span>
			";
			
			
			
			//echo $mensagem;
			
			//die();
			
			$this->enviarmail->carregar($para,$remetente,$assunto,$mensagem);
			$this->enviarmail->enviar();
			
			$var['row'] = $this->OndeEstamosModel->exibirSite();
			$var['felecom'] = $this->FaleConoscoModel->exibirSite();
			$var['sucesso'] = "Mensagem enviada com sucesso!<br />Em breve entraremos em contato.";
			
			$this->load->view('faleconosco', $var);
			//$this->exibir(array('sucesso' => 'Mensagem enviada com sucesso!'));
		}
	}
}
?>
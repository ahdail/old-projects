<?php
class FaleComVereador extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session','form_validation'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/vereadoresmodel',"VereadoresModel");
		
	}
	
	function index ()
	{		
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['assunto'] = $this->VereadoresModel->assunto();
		$var['vereadores'] = $this->VereadoresModel->exibirSite();
		$this->load->view('falecomvereador', $var);
	}
	
	
	
	function enviar() {

		$this->form_validation->set_rules('emailvereador', 'Vereador', 'required');
		$this->form_validation->set_rules('nomeremetente', 'Nome', 'required');
		$this->form_validation->set_rules('emailremetente', 'E-mail', 'required|valid_email');		
		$this->form_validation->set_rules('assuntoremetente', 'Assunto', 'required');
		$this->form_validation->set_rules('mensagemremetente', 'Mensagem', 'required');
		
		$falecomvereadorPost['row'] = $_POST;
		
		if ($this->form_validation->run () == FALSE) {
		
			$falecomvereadorPost['comissoes'] = $this->ComissaoModel->comissaoSite();
			$falecomvereadorPost['apoio'] = $this->ApoioModel->apoioSite();		
			$falecomvereadorPost['legislacoes'] = $this->LegislacaoModel->legislacao();
			$falecomvereadorPost['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
			$falecomvereadorPost['assunto'] = $this->VereadoresModel->assunto();
			$falecomvereadorPost['vereadores'] = $this->VereadoresModel->exibirSite();
			$this->load->view('falecomvereador', $falecomvereadorPost);
		} else {

			$from = "ahdail@gmail.com";
			//$bcc = $var['row']['outroemail'];			
			$to = $this->input->post('emailremetente');			
			$nomeremetente = $this->input->post('nomeremetente');
			
			$para = $from;
			//$remetente = "Babayaga";
			$assunto = $this->input->post('assuntoremetente');
			$mensagem = "
				<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
				<strong>Vereador:</strong>
				{$this->input->post('emailvereador')}
				<br>
				<strong>NOME do REMETENTE:</strong>
				{$this->input->post('nomeremetente')}
				<br>
				<strong>E-MAIL do REMETENTE:</strong>
				{$this->input->post('emailremetente')}
				<br>			
				<strong>ASSUNTO:</strong>				
				{$this->input->post('assuntoremetente')}
				<br><br>
				<strong>MENSAGEM:</strong> <br>
				".nl2br($this->input->post('mensagemremetente'))."
				
				<br><br><br>
				:: Enviado através do site camaramhorizonte.com.br ::
				</span>
			";
			
			$body = "<html>\n";
			$body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
			$body = $mensagem;
			$body .= "</body>\n";
			$body .= "</html>\n";
		   
			$headers  = "From: Câmara Municipal de Horizonte<noreply@camaramhorizonte.com.br>\r\n";
			$headers .= "Reply-To: noreply@camaramhorizonte.com.br\r\n";
			$headers .= "BCC:{$bcc}";
			$headers .= "Return-Path: noreply@camaramhorizonte.com.brr\n";
			$headers .= "X-Mailer: Drupal\n";
			$headers .= 'MIME-Version: 1.0' . "\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		   
			//echo $body;
			
			//die();
		   
			mail($para, "Câmara Municipal de Horizonte - {$assunto}", $mensagem, $headers);
			
			
			
			
			$var['assunto'] = $this->VereadoresModel->assunto();
			$var['vereadores'] = $this->VereadoresModel->exibirSite();
			$var['sucesso'] = "Mensagem enviada com sucesso!<br />Em breve entraremos em contato.";
			
			
			$var['comissoes'] = $this->ComissaoModel->comissaoSite();
			$var['apoio'] = $this->ApoioModel->apoioSite();		
			$var['legislacoes'] = $this->LegislacaoModel->legislacao();
			$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
			
			$this->load->view('falecomvereador', $var);
			
		}
	}
	
}
?>
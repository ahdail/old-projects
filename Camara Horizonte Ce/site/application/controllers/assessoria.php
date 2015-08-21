<?php
class Assessoria extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'reduzircaracter'));
		$this->load->library(array('session','form_validation','pagination'));
		$this->load->model('admin/apoiomodel',"ApoioModel");
		$this->load->model('admin/comissaomodel',"ComissaoModel");
		$this->load->model('admin/legislacaomodel',"LegislacaoModel");
		
		$this->load->model('admin/vereadoresmodel',"VereadoresModel");
		$this->load->model('admin/vozcidadaomodel',"vozcidadaoModel");
		
	}
	
	function index ()
	{		
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
		$var['assunto'] = $this->VereadoresModel->assunto();
		$var['true'] = true ;
		$this->load->view('vozcidadao', $var);
	}

	function enviar() 
	{
		
		$this->form_validation->set_rules('nomeremetente', 'Nome', 'required');
		$this->form_validation->set_rules('emailremetente', 'E-mail', 'required|valid_email');		
		$this->form_validation->set_rules('assuntoremetente', 'Assunto', 'required');
		$this->form_validation->set_rules('mensagemremetente', 'Mensagem', 'required');
		
		$vozcidadaoPost['row'] = $_POST;
		
		if ($this->form_validation->run () == FALSE) {
		
			$vozcidadaoPost['comissoes'] = $this->ComissaoModel->comissaoSite();
			$vozcidadaoPost['apoio'] = $this->ApoioModel->apoioSite();		
			$vozcidadaoPost['legislacoes'] = $this->LegislacaoModel->legislacao();
			$vozcidadaoPost['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
			$vozcidadaoPost['assunto'] = $this->VereadoresModel->assunto();
			//die();
			$var['true'] = true ;
			$this->load->view('vozcidadao', $vozcidadaoPost);
		} else {
					
			$from = "ahdail@gmail.com";
			//$bcc = $var['row']['outroemail'];			
			$to = $this->input->post('emailremetente');			
			$nomeremetente = $this->input->post('nomeremetente');
			
			$para = $from;
			$assunto = $this->input->post('assuntoremetente');
			$mensagem = "
				<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
				<strong>NOME:</strong>
				{$this->input->post('nomeremetente')}
				<br>
				<strong>E-MAIL:</strong>
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
		   
			mail($para, "Câmara Municipal de Horizonte - {$assunto}", $mensagem, $headers);
			
			$var['assunto'] = $this->VereadoresModel->assunto();			
			$var['sucesso'] = "Mensagem enviada com sucesso!<br /><br />Após avaliação sua mensagem será exibida no site.";
						
			$var['comissoes'] = $this->ComissaoModel->comissaoSite();
			$var['apoio'] = $this->ApoioModel->apoioSite();		
			$var['legislacoes'] = $this->LegislacaoModel->legislacao();
			$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
			
			$this->load->view('vozcidadao', $var);
			
		}
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/assessoria/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->vozcidadaoModel->getTotal(),
    		'uri_segment'	=> 4,    		
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
    	
    	$query = $this->vozcidadaoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $var['pag'] = $this->pagination->create_links();
        $var['vozcidadao'] = $query->result_array();
		
		$var['comissoes'] = $this->ComissaoModel->comissaoSite();
		$var['apoio'] = $this->ApoioModel->apoioSite();		
		$var['legislacoes'] = $this->LegislacaoModel->legislacao();
		$var['leismunicipais'] = $this->LegislacaoModel->leimunicipal();
		
        $this->load->view('assessoria',$var);
	}
	
}
?>
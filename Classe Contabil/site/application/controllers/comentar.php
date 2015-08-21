<?php
class Comentar extends MY_Controller {

	function __construct() 
	{
		parent::Controller();	
		
		$this->load->library(array ('form_validation', 'funcoes', 'email') );
		
		$this->load->model('comentarModel',"ComentarModel");
	}
	

	
	function artigo($id)
	{
    	$indica['indica'] = $this->IndicaModel->indicaArtigo($id);
		$this->load->view('indica', $indica);
	}
	
	function juizo($id)
	{
    	$indica['indica'] = $this->IndicaModel->indicaJuizo($id);
		$this->load->view('indica', $indica);
	}
	
	function direito($id)
	{
    	$indica['indica'] = $this->IndicaModel->indicaDireito($id);
		$this->load->view('indica', $indica);
	}
	
	function enviar(){
		// Configuração para o envio de email
		$config = array(
			'protocol' => 'mail' ,// Protocolo de envio de email.
			'mailpath' =>'/usr/bin/sendmail' , //Caminho do Sendmail no servidor
			'smtp_host'=>'no default',//Endereço do Servidor SMTP. 
			'smtp_user'=>'no default',//Usuário SMTP
			'smtp_pass'=>'no default',//Senha SMTP.
			'smtp_port'=>'25',//Porta SMTP.
			'smtp_timeout'=>'5',//Timeout SMTP (em segundos)
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->email->initialize($config);

		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules('nomerem', 'Nome do Remetente', 'required');
		$this->form_validation->set_rules('emailrem', 'E-mail Remetente', 'required|valid_email');
		$this->form_validation->set_rules('nome', 'Nome do Destinatário', 'required');
		$this->form_validation->set_rules('email', 'E-mail Destinatário', 'required|valid_email');
		
		// Carregar os dados preenchidos
		$secaoPost['row'] = $_POST;
		
		$dados = array(
			'nomerem' 	=> $this->input->post('nomerem'),
			'emailrem' 	=> $this->input->post('emailrem'),
			'nome' 		=> $this->input->post('nome'),
			'email' 	=> $this->input->post('email'),
			'mensagem'	=> $this->input->post('mensagem'),			
			'id' 		=> $this->input->post('id'),
			'titulo' 	=> $this->input->post('titulo')
		);
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('indica',$secaoPost);
		} else {
			$this->email->from('emailrem', $dados['emailrem']);
			$this->email->to($dados['email']);
			$this->email->reply_to('emailrem', $dados['emailrem']);
			$this->email->subject($dados['nomerem'].'('.$dados['emailrem'].')'.'enviou uma indicação de leitura');
			$this->email->message($dados['titulo']);
			
			$this->email->send();
			echo $this->email->print_debugger();
			/*print_r($dados);
			die();*/
			$this->load->view('indica');
		}
	}
}	
?>
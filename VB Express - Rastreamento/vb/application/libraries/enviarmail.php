<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class enviarmail
{

	private $para; 
	private $remetente;
	private $assunto; 
	private $mensagem;

	function carregar ($para,$remetente,$assunto,$mensagem)
	{
		$this->para = $para;
		$this->remetente = $remetente;
		$this->assunto = $assunto; 
		$this->mensagem = addslashes($mensagem);
	}
	
	function enviar() 
	{
	    // Coloca a mensagem dentro do template
	    //$mensagem = $this->mensagem;
	    /*ob_start();
	    include ("admin/visualizar");
	    $msg = addslashes(ob_get_clean());*/
	    // Envia a mensagem
	    //$this->mensagem = addslashes($msg);
	    
	    
	    // Se for um array, percorre e envia a cada destinatario
	    if (is_array($this->para)) {
	    	foreach($this->para as $email) {
	    		$send = `/usr/local/bin/mail "Portal da Classe Contábil <$this->remetente>" {$email['email']} "$this->assunto" "$this->mensagem" "$this->remetente" 200.217.166.102 "text/html"`;
	    	}
	    	
	    // Se não for um array, envia ao $para
	    } else {
	    	$send = `/usr/local/bin/mail "Portal da Classe Contábil <$this->remetente>" $this->para "$this->assunto" "$this->mensagem" "$this->remetente" 200.217.166.102 "text/html"`;
	    }
	}
}
?>
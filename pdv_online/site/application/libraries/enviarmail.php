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
		$this->mensagem = $mensagem;
	}
	
	function enviar() 
	{
	    // Coloca a mensagem dentro do template
	    //$mensagem = $this->mensagem;
	    /*ob_start();
	    include ("emailModelo.php");
	    $msg = addslashes(ob_get_clean());*/
	    // Envia a mensagem
	    
	    // Se for um array, percorre e envia a cada destinatario
	    if (is_array($this->para)) {
	    	foreach($this->para as $email) {
	    		$send = `/usr/local/bin/mail "CIC <$this->remetente>" $email "$this->assunto" "$this->mensagem" "$this->remetente" smtp.grupofortes.com.br "text/html"`;
	    	}
	    // Se não for um array, envia ao $para
	    } else {
	    	$send = `/usr/local/bin/mail "CIC <$this->remetente>" $this->para "$this->assunto" "$this->mensagem" "$this->remetente" smtp.grupofortes.com.br "text/html"`;
	    }
	}
}
?>
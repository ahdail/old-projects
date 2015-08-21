<?php
class Busca extends MY_Controller
{
	function index()
	{
		// Monta a URL de requisicao
		$busca = $this->input->post('busca');
		/*$buscaTipo = array(
			1 => "014288877820036578590:wl_-qicyivk", // No classe
			2 => "014288877820036578590:b4u9hpy1dss" // Na web
		);*/
		$codigo = "014288877820036578590:wl_-qicyivk";
		
		$parametros = "cx={$codigo}&ie=iso-8859-1&q={$busca}&css=http://www.classecontabil.com.br/v3/site/css/buscaGoogle.css"; 
		$var['endereco'] = "http://www.dingdong.com.br/busca/buscaGoogle.php?{$parametros}";
		
		// Carrega a View
		$this->render('busca', $var);	
	}
}
?>
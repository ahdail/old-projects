<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rssFeed
{
	private $xml;
	
	// Construtor, inicializa a classe.
	function __construct($cabecalho=false)
	{
		// Se n�o for passado um cabe�alho, utiliza o padr�o
		if (!$cabecalho) {
			$cabecalho = array(
				"title" => "Classe Cont�bil",
				"link" => "http://www.classecont�bil.com.br",
				"description" => "Portal de contabilidade",
				"language" => "pt-br",
				"copyright" => "Todos os direitos reservados.",
				"webMaster" => "desenvolvimento.web@grupofortes.com.br"
			);
		}
		
		// Monta o cabecalho
		$this->makeCabecalho($cabecalho);
	}
	
	// M�todo para adicionar o cabe�alho ao XML
	function makeCabecalho($cabecalho)
	{
		// Inicia o documento XML
		$this->xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n";
		$this->xml .= "<rss version=\"2.0\">\r\n";
		$this->xml .= "<channel>\r\n";
		
		foreach ($cabecalho as $chave => $valor) {
			$this->xml .= "<{$chave}>{$valor}</{$chave}>\r\n";
		}
	}
	
	// M�todo para adicionar itens ao XML
	function addItem($item, $arquivos=false)
	{
		if (is_array($item)) {
			// Inicia o item
			$this->xml .= "<item>\r\n";
			
			// Monta as tags de arquivos, caso exista
			if ($arquivos) {
				foreach($arquivos as $arquivo) {
					$this->xml .= "\t<enclosure";
					foreach ($arquivo as $chave => $valor) {
						$this->xml .= " {$chave}=\"{$valor}\"";
					}
					$this->xml .= "/>\r\n";
				}
			}
			
			// Monta as tags do item
			foreach ($item as $chave => $valor) {
				$this->xml .= "\t<{$chave}><![CDATA[{$valor}]]></{$chave}>\r\n";
			}
			
			// encerra o item
			$this->xml .= "</item>\r\n";
		}
	}
	
	// M�todo para adicionar o rodap� ao XML
	function makeRodape() {
		$this->xml .= "</channel>\r\n";
		$this->xml .= "</rss>";
	}
	
	// M�todo para retornar o XML montado
	function getXML()
	{
		// Cria o rodap�
		$this->makeRodape();
		
		// Retorna o XML
		return $this->xml;	
	}
	
}
?>
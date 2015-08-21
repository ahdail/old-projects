<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rssFeed
{
	private $xml;
	
	// Construtor, inicializa a classe.
	function __construct($cabecalho=false)
	{
		// Se não for passado um cabeçalho, utiliza o padrão
		if (!$cabecalho) {
			$cabecalho = array(
				"title" => "Classe Contábil",
				"link" => "http://www.classecontábil.com.br",
				"description" => "Portal de contabilidade",
				"language" => "pt-br",
				"copyright" => "Todos os direitos reservados.",
				"webMaster" => "desenvolvimento.web@grupofortes.com.br"
			);
		}
		
		// Monta o cabecalho
		$this->makeCabecalho($cabecalho);
	}
	
	// Método para adicionar o cabeçalho ao XML
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
	
	// Método para adicionar itens ao XML
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
	
	// Método para adicionar o rodapé ao XML
	function makeRodape() {
		$this->xml .= "</channel>\r\n";
		$this->xml .= "</rss>";
	}
	
	// Método para retornar o XML montado
	function getXML()
	{
		// Cria o rodapé
		$this->makeRodape();
		
		// Retorna o XML
		return $this->xml;	
	}
	
}
?>
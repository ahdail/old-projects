<?php
function highlight($conteudo, $palavras) {//$x is the string, $var is the text to be highlighted
	if ($palavras) {
		// Pega todas as palavras
		$palavraArray = explode(' ', $palavras);
		foreach ($palavraArray as $palavra => $valorPalavra) {
			$encontrar[] = $valorPalavra;
			$substituir[] = "<font color='#990000' style='background:yellow'>{$valorPalavra}</font>";
		}		
		
		// Substitui os resultados encontrados e devolve o resultado
		return str_ireplace($encontrar, $substituir, $conteudo);
	} else {
		return $conteudo;
	}
}
?>
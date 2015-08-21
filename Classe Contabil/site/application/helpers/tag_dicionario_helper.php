<?php
function inserirTags ($conteudo)
{
	// Cria a instancia do CI
	$CI = &get_instance();
	
	// Carrega as tags do dicionario
	$CI->load->model('dicionariomodel',"DicionarioModel");
	$tags = $CI->DicionarioModel->getTodos();
	
	// Cria o array de procura e substituicao
	foreach ($tags as $row) {
		$encontrar[] = " ".$row['palavra']." ";
		$substituir[] = " <span class=\"dic\" onmouseout=\"ocultarPalavra();\" onmouseover=\"exibirPalavra({$row['id']}, '".base_url()."', this)\">{$row['palavra']}</span> "; 
	}
	
	// Substitui os resultados encontrados e devolve o resultado
	return str_ireplace($encontrar, $substituir, $conteudo);
}

?>
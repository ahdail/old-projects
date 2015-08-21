var timeoutPalavra

function exibirPalavra(idPalavra, baseUrl, link, highlight) {
	// Carrega o conteúdo da palavra após 800 milesegundos
	//timeoutPalavra = window.setTimeout("carregarPalavra("+idPalavra+", "+baseUrl+", "+link+", "+highlight+")", 800);
	timeoutPalavra = window.setTimeout(function() {
		carregarPalavra(idPalavra, baseUrl, link, highlight);
	}, 800);
}

function carregarPalavra(idPalavra, baseUrl, link, highlight) {
	//Posiciona a div de acordo com o link
	var posicaoLink = $(link).offset();
	$('#divPalavra').css('left', posicaoLink.left).css('top', posicaoLink.top+20);
	
	//Exibe a div
	$('#divPalavra').html('<br><br><center><b>Carregando...</b></center><br><br>').show();

	// Carrega o conteúdo da palavra
	if (!highlight) highlight = "";
	$.post(baseUrl+"dicionario/detalhar/"+idPalavra, 'highlight='+highlight, function(retorno) {
		$('#divPalavra').html(retorno);
	});
}

function ocultarPalavra() {
	$('#divPalavra').hide();
	window.clearTimeout(timeoutPalavra);
}
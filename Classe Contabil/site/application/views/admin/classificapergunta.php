<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/tabelas.css" />

<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.meiomask.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
	$('#data').setMask('date');
});

var qtdPerguntas = <?=$qtdPerguntas?>;

function mudaTema(id) {
	var endereco = "<?=base_url()?>admin/classificapergunta/";
	var novoTema = $('#tema_'+id).val();
	
	if (novoTema > 0) {
		var ultimaLinha = $('#tableBody tr:last');
		var proxCor = ($(ultimaLinha).attr('class') == 'cor1') ? 1 : 0;

		// Atualiza o tema
		$.post(endereco+'atualizarTema/', 'idPergunta='+id+'&idTema='+novoTema, function() {
			// Carrega a proxima pergunta
			$.post(endereco+'exibirProximaPergunta/', 'data=<?=$data?>&cor='+proxCor, function(retorno) {
				// Insere a proxima pergunta ao fim da linha
				$(ultimaLinha).after(retorno);
			});
		});
		
		// Esconde a linha
		$('#linha_'+id).fadeOut(500);

		// Subtrai o total de perguntas restantes
		qtdPerguntas = qtdPerguntas-1;
		$('#qtdPerguntas').html(qtdPerguntas);
		
	} else {
		alert('Selecione um tema');
	}
}
</script>
</head>
<body>
<form method="post" action="<?= base_url() ?>admin/classificapergunta/index">
<table id="tabelaAdm">
  <thead>
    <tr>
      <th colspan="3" scope="col">Filtro</th>
    </tr>
  </thead>
  <tbody>
  <tr>
	<td width="145" style="border: 1px solid #000000;"><iframe name="calendarioMes" src="<?= base_url() ?>admin/classificapergunta/exibirCalendario" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="145" height="144"></iframe></td>
    <td width="60" valign="top"><label>Data:</label></td>
    <td valign="top">
    <input type="text" name="data" id="data" value="<?=sqlToDate($data)?>"> <input type="submit" value="Filtrar">
    </td>
  </tr>
  </tbody>
</table>
</form>
<?
if ($perguntas) {
	foreach($temas as $tema) {
		$temasOptions .= "<option value='{$tema['id']}'>{$tema['tema']}</option>\n";
	}
	?>
	<span style="font-family: Verdana; font-size: 11px;">Total de perguntas em <b><?=sqlToDate($data)?></b>: [<span id="qtdPerguntas"><?=$qtdPerguntas?></span>]</span>
	<table id="tabelaAdm">
	  <thead>
	    <tr>
	      <th scope="col">Pergunta</th>
	      <th scope="col">Tema</th>
	    </tr>
	  </thead>
	  <tbody id="tableBody">
	  <? foreach($perguntas as $pergunta) { ?>
		   <tr class="<?=$this->alterarcor->pegar()?>" id="linha_<?=$pergunta['id']?>">
		     <th scope="col"><?=$pergunta['pergunta']?></th>
		     <th scope="col">
		     <select id="tema_<?=$pergunta['id']?>" style="width: 400px;">
		     	<option value="0">Selecione:</option>
	  			<?=$temasOptions?>
		     </select>
		     
		     <a href="#nogo" onclick="mudaTema(<?=$pergunta['id']?>);">[OK]</a>
		     </th>
		   </tr>
	  <? } ?>
	  </tbody>
	</table>
	<?
}
?>
</body>
</html>
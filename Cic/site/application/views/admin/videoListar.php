<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/cicloDebate/videoDeletar/"+id;
		}
	}
</script>
</head>
<body>
<div>
<?
	if ($mostra) {
		foreach ($mostra as $row2) {
			$arquivo = base_url()."site/videos/".$row[arquivo];
			echo "
				<embed
						src=\"http://www.fortesinformatica.com.br/mediaplayer/tocador.swf\"
						width=\"300\"
						height=\"200\"
						allowscriptaccess=\"always\"
						allowfullscreen=\"true\"
						flashvars=file=$arquivo/>
				</embed>	";
			} 
		}
?>
</div><br>
	<table class="listar" cellspacing="1" cellpadding="1">
		<tr class="titulo">
			<td align="center">Programa</td>
			<td align="center">Parte</td>
			<td align="center">Video</td>
			<td align="center">Resumo</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<? foreach ($video as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC";
			else $cor = "#FFFFFF";
		?>
		<?= base_url()?>site/videos/<?=$row['arquivo']?>
		<tr style="background-color: <?=$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?=$row['titulo']?></td>
			<td style="font-size: 11px" align="center"><?=$row['parte']?></td>
			<td style="font-size: 11px" align="center">
					<embed
						src="http://www.fortesinformatica.com.br/mediaplayer/tocador.swf"
						width="300"
						height="200"
						allowscriptaccess="always"
						allowfullscreen="true"
						flashvars="file=<?= base_url()?>site/videos/<?=$row['arquivo']?>"
					/></embed>
			</td style="font-size: 11px" align="center">
			<td style="font-size: 11px" align="center"><?=$row['resumo']?></td>
			<td align="center" class="acoes">
				<a href="<?= base_url()?>admin/cicloDebate/videoDetalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Video" onclick="window.location.href='<?= base_url()?>admin/cicloDebate/videoDetalhar/0';"  class="botao" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>
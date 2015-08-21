<?php header("Content-type: text/html; charset=ISO-8859-1"); ?>
<table class="listar" cellspacing="1" cellpadding="1">
	<tr class="titulo">
		<td align="center">Parte</td>
		<td align="center">Video</td>
		<td align="center">Resumo</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<?php
	foreach ($video as $row) { 
		$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
		<tr style="background-color: <?php echo $cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?php echo $row['parte']?></td>
			<td style="font-size: 11px" align="center">
			<embed
				src="http://www.fortesinformatica.com.br/mediaplayer/tocador.swf"
				width="300"
				height="200"
				allowscriptaccess="always"
				allowfullscreen="true"
				flashvars="file=<?php echo base_url()?>site/videos/<?php echo $row['arquivo']?>"
			/></embed>
			</td style="font-size: 11px" align="center">
			<td style="font-size: 11px" align="center"><?php echo $row['resumo']?></td>
			<td align="center" class="acoes">
				<a href="#" onclick="detalharVideo(<?php echo $idPrograma?>, <?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletarVideo(<?php echo $idPrograma?>, <?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<?php
	 }
	 ?>
</table>
<br>
<div align="center"><input type="button" value="Novo Video" onclick="detalharVideo(<?php echo $idPrograma?>, 0)"/></div>
<br>
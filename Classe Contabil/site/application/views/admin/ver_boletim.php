<?php checkSessao("BOL.E") ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<style>
body {
	margin: 0;
	padding: 0;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background: #F9F9F9;
}
</style>
<script type="text/javascript">
function popup(url)
{
	window.open(url,'page','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200');
}
</script>
</head>
<body>
<div>
	<form action="<?=base_url() ?>admin/boletim/ver_montado" method="post" style="width: 570px;">
	
	<h1>Selecionar Boletim</h1>
	<ul>
		<li>
		<label style="width: 250px">Qual boletim você deseja visualizar?</label>
		<select name="idBoletim">
		<?php foreach ($boletim_id_aux as $row) {?>
			<option value="<?=$row['id']?>" <?php if ($row['id'] == $idUltimo) { echo " selected=\"selected\" ";}?> ><?= $row['id'] ?></option>
		<?php }?>
		</select>
		<input type="submit" value="Ver">
		</li>
		<?php 
			$urlTeste = base_url()."admin/boletim/testeEnviarBoletim/".$data_envio."/".$idUltimo."/teste";
			$urlEnvio = base_url()."admin/boletim/enviarBoletim/".$data_envio."/".$idUltimo."/enviar";
		?>
		<li>
			<?php if ($enviada == "N") {?>
				<label style="font-size: 11px; color: #FF0000">Boletim não enviado</label>
			<?php } else {?>
				<label style="font-size: 11px; color: #0000A4">Boletim enviado</label>
			<?php }?>
			<input type="button" onclick="popup('<?= $urlTeste?>');" value="Teste Envio" >
			<input type="button" onclick="popup('<?= $urlEnvio?>');" value="Enviar" >
		</li>
	</ul>
	</form>
</div>

<br />

<table cellpadding="20" style="margin: 0 auto; padding: 0; width: 570px; background: #FFFFFF; border: 3px solid #F3F3F3;">
	<thead style="text-align: left">
		<tr>
			<th style="padding-bottom: 10px; padding-left: 15px; padding-right: 15px; border-bottom: 5px solid #CFF6F0;">
				<span style="float: right; text-align: right;">
					<br />
					<h1 style="margin: 0; padding: 0; font-size: 20px; color: #03497A;">Boletim Eletrônico</h1>
					<h2	style="margin: 0; padding: 0; font-size: 12px; font-weight: normal; color: #03497A;"><?=sqlToDate($data_envio)?></h2>
				</span>
				<a href="http://www.classecontabil.com.br/" target="_blank"><img src="http://www.classecontabil.com.br/v3/site/img/topoLogo.gif" alt="Portal da Classe Contábil" border="0" /></a>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($noticias) { ?> 	
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Notícias</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($noticias as $rowNoticia) {?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<a href="<?= base_url() ?>noticias/ver/<?=$rowNoticia['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"> <?= sqlToDate($rowNoticia['data']) ?> - <?=$rowNoticia['titulo']?></h1>
								<p style="margin: 0; font-size: 10px;"><?=$rowNoticia['resumo']?></p></a>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
		<tr>
			<td>
				<?php if ($banner5) {?>
					<?php foreach ($banner5 as $rowBanner) {
						if ($rowBanner['novaJanela'] == "S") {
							$target = "_BLANK";
						} else {	
							$target = "";
						}	
					?>
						<a href="<?= base_url()?>click/contadorClick/<?=$rowBanner['id'] ?>" <?=$target?>>
							<img src="<?= base_url()?>site/banners/<?=$rowBanner['arquivo']?>"  width="<?=$rowBanner['largura']?>" height="<?=$rowBanner['altura']?>" border="0">
						</a>
				<?php } }?>
			</td>
		</tr>
		<?php if ($artigos) { ?> 	
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Artigos</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($artigos as $rowArtigo) {?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<a href="<?= base_url() ?>artigos/ver/<?=$rowArtigo['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"><?= sqlToDate($rowArtigo['data']) ?> - <?=$rowNoticia['titulo']?></h1>
								<p style="margin: 0; font-size: 10px;"><?=$rowArtigo['resumo']?></p></a>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
		<?php if ($juizo) { ?> 	
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Juizo</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($juizo as $rowJuizo) {?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<a href="<?= base_url() ?>juizodiario/ver/<?=$rowJuizo['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"><?=$rowJuizo['pergunta']?></h1>
								<p style="margin: 0; font-size: 10px;"><?=$rowJuizo['resposta']?></p></a>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
	</tbody>
	<tfoot style="font-size: 10px; text-align: center; color: #666666;">
		<tr>
			<td style="border-top: 5px solid #CFF6F0;">
				O <a href="http://www.classecontabil.com.br/" target="_blank" style="color: #666666"><b>Classe Contábil</b></a> é o mais completo portal de informações contábeis do país.<br />
				Conheça também as empresas do <a href="http://www.grupofortes.com.br/" target="_blank" style="color: #666666"><b>Grupo Fortes de Seviços</b></a>.
			</td>
		</tr>
	</tfoot>
</table>

</body>
</html>
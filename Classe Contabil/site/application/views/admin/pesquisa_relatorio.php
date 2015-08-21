<?php 
checkSessao("PES");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />

<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("#cargos1").append($("#cargos2 option[trans=1]"));
});

function transfereItem(idList, idList2){
	$("#"+idList2).append($("#"+idList+" option:selected"));
}

function preparaForm() {
	$('#cargos2 option').attr("selected","true");
}
</script>
</head>
<body>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php }  ?>
<form method="post" action="<?= base_url() ?>admin/pesquisa/montaRelatorio" onsubmit="preparaForm();">
		<h1>RELATORIO PESQUISAS</h1>
		<ul>
			<li>
				<label>Pesquisa <span>*</span></label>
				<select name="idPesquisa">
				<?php foreach ($pesquisas as $rowPesquisa) { ?>
					<option value="<?=$rowPesquisa['id']?>" <? if ($rowPesquisa['id'] == $row['idPesquisa']) echo "selected"; ?>><?=$rowPesquisa['pesquisa']?></option>
				<?php }?>
				</select>
			</li>
			<li>
				<label>Estado <span>*</span></label>
				<select name="idEstado">
					<option value="0">Todos</option>
					<?php foreach ($estados as $rowEstado) { ?>
						<option value="<?=$rowEstado['sigla']?>" <? if ($rowEstado['sigla'] == $row['idEstado']) echo "selected"; ?>><?=$rowEstado['nome']?></option>
					<?php }?>
				</select>
			</li>
			<li>
				<label>Cargo</label>
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
						<select name="cargos1" id="cargos1" size="10" multiple="multiple">
						<? foreach ($cargos as $rowCargo) {	?>
							<option <? if ($row['idCargos'][$rowCargo['id']]) echo "trans='1'"; ?> value="<?=$rowCargo['id']?>"><?=$rowCargo['nome']?></option>
						<? } ?>
						</select>
					</td>
					<td>
						<a href="#nogo" onclick="transfereItem('cargos1', 'cargos2');"><<</a>
						<a href="#nogo" onclick="transfereItem('cargos1', 'cargos2');">>></a>
					</td>
					<td>
						<select name="idCargos[]" style="width: 200px;" id="cargos2" size="10" multiple="multiple">
						</select>
					</td>
				</tr>
				</table>
			</li>
				<input type="submit" value="Montar">
			<li>
		</ul>
</form>
</body>
</html>
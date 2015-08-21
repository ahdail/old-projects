<?
checkSessao("NOT");
$id = ($row['id']) ? $row['id'] : 0
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');

var oEdit2 = new preparaEditor('oEdit2');

function mostraEscondeCampos() {
	if (document.getElementById('dtk').checked==true) {
		document.getElementById('ico').style.display='block';
	} else {
		document.getElementById('ico').style.display='none';
	}
}
</script>
<script language="javascript" type="text/javascript">
function cadastraTag() {
	
	var tag = $('#tag').val();
	$('#divTag').html('Carregando...');
	
	$.post('<?=base_url()?>admin/noticia/tagCadastrar', 'tag='+tag+'&id=<?=$id?>', function(retorno) {
		$('#divTag').html(retorno);
	});
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>

<?php if($_POST['acao'] == "edit"){?>
<div class="msgOk">Edição realizada com sucesso!</div>
<?php }
if ($_POST['acao'] == "add"){?>
<div class="msgOk">Cadastro realizada com sucesso!</div>
<?php }?>

<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($error) { ?>
<div class="msgErro"><?=$error; ?></div>
<?php } ?>

<form method="post" action="<?= base_url() ?>admin/noticia/manter" enctype="multipart/form-data">
		<h1>CADASTRO DE NOTÍCIAS</h1>
		<ul>
			<li>
				<label>Título <span>*</span></label>
				<input type="text" class="campoGd" name="titulo" value="<?=$row['titulo']?>" />
			</li>
			<li>
				<label>Data</label>
				<?php 
					if ($row['data']) {
						$data = $row['data']; 
					} else {
						$data = date("d/m/Y");
					}
				?>
				<input type="text" class="campoPeq" name="data" value="<?=$data ?>" onFocus="setYears(<?=date("Y")?>, <?=date("Y+1")?>); showCalender(this, 'data');" onKeyDown="return false;" />
			</li>
			<li>
				<label>Resumo <span>*</span></label>
				<textarea id="resumo" name="resumo" style="height: 100px;" class="campo"><?=$row['resumo']?></textarea>
				<script>oEdit1.REPLACE("resumo");</script>
			</li>
			<li>
				<label>Conteúdo <span>*</span></label>
				<textarea id="conteudo" name="conteudo" class="campo"><?=$row['conteudo']?></textarea>
				<script>oEdit2.REPLACE("conteudo");</script>
			</li>
			<li>
				<label title="Nome/Descrição da Fonte">Fonte</label>
					<select type="text" name="fonte">
						<option value="">Selecione uma fonte...</option>
						<?php foreach ($fontes as $rowFonte) {?>
							<option value="<?=$rowFonte['id']?>" <?php if ($rowFonte['id'] == $row['fonte']) { echo " selected=\"selected\" "; }?> > <?=$rowFonte['nomeFonte']?> </option>
						<?php }?>
					</select><br />
			</li>
			<li>
				<label>Opções:</label>
				<?php 
					if ($row['inserirImagem'] == "S") {
						$marcadoExibirImagem = "checked=checked";
						$display = " style=\"display:block;\" ";
					} else {
						$marcadoExibirImagem= "";
						$display =  " style=\"display:none;\" ";
					}
					if ($row['exibirPrincipal'] == "S") {
						$marcadoExibirPrincipal = "checked=checked";
					} else {
						$marcadoExibirPrincipal= "";
					}
					if ($row['exibirDestaque'] == "S") {
						$marcadoExibirDestaque = "checked=checked";
					} else {
						$marcadoExibirDestaque = "";
					}
				?>
				
				<input type="checkbox" name="exibirPrincipal"  value="S" <?=$marcadoExibirPrincipal ?>><span style="font-size:12px;"> Exibir na Pág. Principal</span></br>
				<label>&nbsp;</label><input type="checkbox" name="exibirDestaque"  value="S"  <?=$marcadoExibirDestaque ?> ><span style="font-size:12px;"> Exibir como Destaque</span></br>
				<label>&nbsp;</label><input type="checkbox" id="dtk" name="inserirImagem" onclick="mostraEscondeCampos();" value="S" <?=$marcadoExibirImagem ?> ><span style="font-size:12px;"> Inserir Imagem</span></br>
				<li id="ico" <?=$display ?>>
					<label>Ícone destaque<span>*</span></label>
					<input type="file" class="campoGd" name="userfile"/>&nbsp;&nbsp;<?php if ($row['icoDestaque']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
					<font size=1px style="font-weight: bold">&nbsp;&nbsp;(tamanho recomendado: 70px × 70px)</font>
				</li>
			</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
				<input type=reset value=Limpar class="" />
			</li>
			<br>
			<li>
				<label><b>CADASTRO DE TAG</b></label> 
			</li>
			<br>
			<div id="divTag"><?=$tag?></div>
		</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>



<table id="calenderTable" border="0" cellspacing="0" cellpadding="0">
<tbody id="calenderTableHead">
<tr>
 <td colspan="7" align="left" background="<?= base_url()?>site/js/calendario/images/repliBarra.gif">
 
 <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <select name="select" id="selectMonth" onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value, this.selectedIndex, false));">
          <option value="0">Jan</option>
          <option value="1">Fev</option>
          <option value="2">Mar</option>
          <option value="3">Abr</option>
          <option value="4">Mai</option>
          <option value="5">Jun</option>
          <option value="6">Jul</option>
          <option value="7">Ago</option>
          <option value="8">Set</option>
          <option value="9">Out</option>
          <option value="10">Nov</option>
          <option value="11">Dez</option>
        </select></td>
        <td>
        <select name="select2" id="selectYear" onChange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));">
        </select>        </td>
        <td width="25" align="right"><a href="#" onClick="closeCalender();"><img src="<?= base_url()?>site/js/calendario/images/x.gif" border="0"></a></td>
      </tr>
    </table>    </td>
 </tr>
</tbody>
<tbody id="calenderTableDays">
<tr style="font-family: Verdana, Arial, Helvetica, sans-serif; size:10px; font-weight:bold;">
 <td>D</td><td>S</td><td>T</td><td>Q</td><td>Q</td><td>S</td><td>S</td>
</tr>
</tbody>
<tbody id="calender"></tbody>
</table>



</body>
</html>
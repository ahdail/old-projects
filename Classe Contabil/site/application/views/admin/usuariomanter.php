<?php 
checkSessao("ADM.USR");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/dialog_box.css" />
<script type="text/javascript" src="<?= base_url()?>site/js/dialog_box.js"></script>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/dialog_box.js"></script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) {?>
<span id="content"><script type="text/javascript">showDialog('Erro','<?php echo ereg_replace("\n", '<br>', validation_errors()); ?>','error');</script></span>
<?php } ?>
<form method="post" id="form1"  action="<?= base_url() ?>admin/usuario/manter">
	<div>
		<h1>CADASTRO DE USUÁRIOS</h1>
		<ul>
			<li>
				<label>Nome <span>*</span></label>
				<input type="text" class="campo" name="nome" value="<?=$row['nome']?>" />
			</li>
			<li>
			<font style="font-size: 10px;font-style: ">
				<label>Login <span>*</span></label>
				<?php 
					if ($row['id'] > 0) {
						$readonly = "readonly=readonly";
					} else {				
						$readonly = "";
					}
				?>
				<input type="text" class="campo" name="login"  <?=$readonly ?> value="<?=$row['login']?>" />
			</li>
			<li>
				<label>Senha <span>*</span></label>
				<input type="password" class="campoPeq" name="senha"  />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
			</li>
			<li>
				<label>Repita senha <span>*</span></label>
				<input type="password" name="rsenha" class="campoPeq" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
			</li>
			<li>
				<label>Perfil<span>*</span></label>
				<select class="campo" name="idPerfil" id="idPerfil">
    			<? foreach ($perfil as $row2) { 
    				if($row2['id'] == $row['idPerfil']){
    					$selecionado = "selected";
    				} else {
    					$selecionado = "";
    				}
    			?>
    				<option value='<?=$row2['id']?>' <?=$selecionado?> > <?=$row2['nome']?></option>
				<? } ?>
   			</select>
			</li>
			<li><label>&nbsp;</label> 
				<input type=submit value=Gravar class="botao" /> 
				<input type=reset value=Limpar class="botao" />
			</li>
		</ul>
	</div>
<input type="hidden" name="id" value="<?=$row['id']?>">
</form>
</body>
</html>
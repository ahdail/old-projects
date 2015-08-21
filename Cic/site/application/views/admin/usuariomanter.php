<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/dialog_box.css" />
<script type="text/javascript" src="<?php echo base_url()?>site/js/dialog_box.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/dialog_box.js"></script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php }?>
<form method="post" id="form1"  action="<?php echo base_url() ?>admin/usuario/manter">
		<h1>CADASTRO DE USUÁRIOS</h1>
		<ul>
			<li>
				<label>Nome<span>*</span></label>
				<input type="text" class="campo" name="nome" value="<?php echo $row['nome']?>" />
			</li>
			<li>
				<label>Login<span>*</span></label>
				<?php 
					if ($row['id'] > 0) {
						$readonly = "readonly=readonly";
					} else {				
						$readonly = "";
					}
				?>
				<input type="text" class="campo" name="login"  <?php echo $readonly ?> value="<?php echo $row['login']?>" />
			</li>
			<li>
				<label>Senha<span>*</span></label>
				<input type="password" class="campoPeq" name="senha"  />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
			</li>
			<li>
				<label>Repita senha<span>*</span></label>
				<input type="password" name="rsenha" class="campoPeq" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
			</li>
			<li>
				<label>Perfil<span>*</span></label>
				<select class="campo" name="idPerfil" id="idPerfil">
				<option value="" selected="selected"></option>
    			<?php foreach ($perfil as $row2) { 
    				if($row2['id'] == $row['idPerfil']){
    					$selecionado = "selected";
    				} else {
    					$selecionado = "";
    				}
    			?>
    				<option value='<?php echo $row2['id']?>' <?php echo $selecionado?> > <?php echo $row2['perfil']?></option>
				<?php } ?>
   			</select>
			</li>
			<li><label>&nbsp;</label> 
				<input type=submit value=Gravar> 
			</li>
		</ul>
<input type="hidden" name="id" value="<?php echo $row['id']?>">
<?php if($row['id']){?>
<input type="hidden" name="acao" value="edit">
<?php } else {?>
<input type="hidden" name="acao" value="add">
<?php }?>
</form>
</body>
</html>
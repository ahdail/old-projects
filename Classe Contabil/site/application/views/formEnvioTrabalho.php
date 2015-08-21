<?php 

if (!$session_email){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	redirect('login', 'location');
}
?>
<script language='javascript'>
$(document).ready(function() {
	$('#titulo').focus();
});
</script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
<!-- Foemulï¿½rio para cadastro de novos usuï¿½rios -->
<div id="divConteudo">
	<h1 class="titulo">Cadastro de Trabalhos Acadêmicos</h1>
	<div class="divisa"></div>
	<form action="<?= base_url()?>trabalho/manter" method="post" enctype="multipart/form-data">
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?=validation_errors(); ?></div>
	<?php }?>
	<?php if ($result) { ?>
	<div class="msgOk"><?= $result ?></div>
	<?php }?>
		<fieldset>
			<label style="width: 120px">Tipo trabalho</label>
			<select name="esquema" style="width: 230px">
				<option value="1" <?php if ($rowTrab['esquema'] == 1 || $rowTrab['esquema'] == "") {echo "selected=selected "; } ?> >Trabalho Acadêmico</option>
				<option value="2" <?php if ($rowTrab['esquema'] == 2 ){ echo "selected=selected "; } ?> >Artigo</option>
			</select><br />
			<label style="width: 120px">Título<span style="color: red; ">*</span></label>
			<input style="width: 380px" type="text" name="titulo" value="<?=$rowTrab['titulo']?>" /><br />
			
			<label style="width: 120px">Resumo<span style="color: red; ">*</span></label>
			<textarea style="width: 380px" rows="6" name="resumo" class="campo"><?=$rowTrab['resumo']?></textarea><br />

			<label style="width: 120px">Selecione arquivo<span style="color: red; ">*</span></label>
			<input style="width: 230px" type="file" name="userfile" size="20"  class="campo" /><br />
			<label style="width: 120px">&nbsp;</label>
			<small style="color: red">O nome dos arquivos não pode conter acentos nem espaços.</small><br /><br />

			<label style="width: 120px">Tipo de Arquivo</label>
			<input type="radio" name="tipo" id="tipo" value="1"  <?php if ($rowTrab['tipo'] == 1 || $rowTrab['tipo'] == "") {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/doc.gif" alt=".doc" title="Arquivo DOC" />
			<input type="radio" name="tipo" value="2" <?php if ($rowTrab['tipo'] == 2) {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/pdf.gif" alt=".pdf" title="Arquivo PDF" /><br />

			<label style="width: 120px">Autor(s)<span style="color: red; ">*</span></label>
			<textarea style="width: 380px" rows="3" name="autor"><?=$rowTrab['autor']?></textarea> <small>Cada linha um autor</small><br />

			<label style="width: 120px">Orientador(s)</label>
			<textarea style="width: 380px" rows="3" name="orientador"><?=$rowTrab['orientador']?></textarea> <small>Cada linha um orientador</small><br />

			<label style="width: 120px">&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
		</fieldset>
		<input type="hidden" name="email" value="<?=$session_email?>" >
		<input type="hidden" name="nome" value="<?=$session_login?>" >
	</form>
</div>

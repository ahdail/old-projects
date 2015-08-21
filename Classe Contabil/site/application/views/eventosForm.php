<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.meiomask.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
	$('#data').setMask('date');
});
</script>

<!-- CONTEï¿½DO -->
<div id="divConteudo">
	<h1 class="titulo">Divulge seu Evento</h1>
	<div class="divisa"></div><br />
	<form action="<?php echo  base_url()?>eventos/cadastrar" method="post">
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?php echo validation_errors(); ?></div>
	<?php }?>
	<?php if ($msg) { ?>
	<div class="msgOk"><?php echo $msg ?></div>
	<?php }?>
	<p>O Portal da Classe Contábil apoia a categoria divulgando eventos de entidades e instituições contábeis.</p>
	<p>Divulgue o evento do seu Conselho, Sindicato, Universidade ou Faculdade aqui.</p>
	<p>As veracidade das informações cadastradas é de responsabilidade do autor.</p>
		<fieldset>
			<label style="width: 110px">Nome do Evento</label><input style="width: 300px" name="titulo" value="<?php echo $rowEvento['titulo']?>" type="text"><br />
			<label style="width: 110px">Local</label><input style="width: 300px" name="local" value="<?php echo $rowEvento['local']?>" type="text"><br />
			<label style="width: 110px">Data</label>
			<input type="text" name="data" id="data" value="<?php echo $rowEvento['data']?>" /><br />
			<label style="width: 110px">E-mail p/ contato</label><input style="width: 300px" name="email" value="<?php echo $rowEvento['email']?>" type="text"><br />
			<span>Descrição do Evento <i>(Breve descrição contendo: data, horário, telefone para contato, local)</i></span><br />
			<textarea name="descricao" style="width: 100%" rows="10" ><?php echo $rowEvento['descricao']?></textarea><br />
			<input type="submit" value="Enviar">
		</fieldset>
	</form>	
</div>



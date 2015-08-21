<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		
	<div id="content">
		
			<h1 class="title"><a href="#">A voz do cidadão</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			
			
			
			<div class="entry">				
				&#8220; Este espaço é reservado para todos os cidadãos expressarem suas opiniões, sugestões, críticas, dúvidas e etc.&#8221;						
				<p class="byline"><small>&nbsp;</small></p>		
			</div>
			<div class="entry" style="float:left;" >

				<?php if (validation_errors()) { ?>
				<div class="msgErro" style="border:1px dashed  #AE494B; color:#AE494B;; padding:10px"><?php echo validation_errors(); ?></div><br />
				<?php }  ?>
				<?php if ($sucesso) { ?>
				
				<div class="msgOk" style="border:1px dashed  #98CE15;color:#006532; padding:10px">
				<b><?php echo $sucesso; ?></b>
				</div><br />
				<?php }  ?>
				
				<form action="<?php echo base_url()?>vozcidadao/enviar" method="post">
					
				
					<label class="label">Nome</label><br />
					<input type="text" name="nomeremetente" class="text_field" style="width:300px" /><br/><br/>
					<label class="label">Email</label><br />
					<input type="text" name="emailremetente" class="text_field" style="width:300px"/><br/><br/>
					<label class="label">Assunto</label><br />
					<select name="assuntoremetente">
						<option value="">selecione</option>
						<?php foreach ($assunto as $row) {?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['assunto'];?></option>
						<? } ?>
					</select><br /><br />
					<label class="label">Mensagem</label><br>
					<textarea name="mensagemremetente" rows="5" cols="60"></textarea>  <br/><br/>
					<input type="submit" value="Enviar">
				</form>
	
				<br clear="all" />					
				
			</div>
			<div class="entry">	*Após avaliação, sua opinião será exibida neste site.</div>

		<br clear="all" />
		
		
	</div>
		<!-- end content -->
<?php include("final.inc.php");?>
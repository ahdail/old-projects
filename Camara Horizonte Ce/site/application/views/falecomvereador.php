<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		
<script>
			function mostrar() {
				obj1 = document.getElementById("div1");
				if (obj1.style.display=='block') {
					obj1.style.display='none';
				} else {
					obj1.style.display='block';
				}
			}
		</script>
		
	<div id="content">
		
			<h1 class="title"><a href="#">Fale com seu Vereador</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			
			<div class="entry">				
				&#8220; Entre em contato com seu vereador. Deixe suas críticas e sugestões&#8221;						
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
				
				<form action="<?php echo base_url()?>falecomvereador/enviar" method="post">
					<label class="label">Vereador</label><br />
					<select name="emailvereador">
						<option value="">selecione</option>
						<?php foreach ($vereadores as $row) {?>
						<option value="<?php echo $row['email']?>"><?php echo $row['nome'];?> - <?php echo $row['email'] ?></option>
						<? } ?>
					</select><br /><br />
				
					<label class="label">Nome</label><br />					
					<input type="text" name="nomeremetente" class="text_field" style="width:300px" /><br/><br/>
					<label class="label">Email</label><br />
					<input type="text" name="emailremetente" class="text_field" style="width:300px"/><br/><br/>
					<label class="label">Assunto</label><br />
					<select name="assuntoremetente">
						<option value="">selecione</option>
						<?php foreach ($assunto as $row) {?>
						<option value="<?php echo $row['assunto'] ?>"><?php echo $row['assunto'];?></option>
						<? } ?>
					</select><br /><br />
					<label class="label">Mensagem</label><br>
					<textarea name="mensagemremetente" rows="5" cols="60"></textarea>  <br/><br/>
					<input type="submit" value="Enviar">
				</form>
	
				<br clear="all" />					
				
			</div>
			

		<br clear="all" />
		
	</div>
		<!-- end content -->
<?php include("final.inc.php");?>
<?php include_once "inicio.inc.php" ?>

	<div id="cont" class="grid_9 omega">
		<h3>Governo &raquo; Ouvidoria</h3>
		
		<h4>Entre em contato conosco</h4>
		

		<form style="color:#666" action="<?php echo base_url();?>contato/envia_email" method="post">
			<br clear="all" />

			<label class="label">Nome</label><br />					
			<input type="text" name="nomeremetente" class="text_field" style="width:300px" /><br/><br/>
			<label class="label">Email</label><br />
			<input type="text" name="emailremetente" class="text_field" style="width:300px"/><br/><br/>

			<label class="label">Assunto</label><br />
			<select name="assuntoremetente">
				<option value="0">selecione...</option>
				<option value="Sugestão">Sugestão</option>
				<option value="Crítica">Crítica</option>
				<option value="Opinião">Opinião</option>
				<option value="Reclamação">Reclamação</option>
			</select><br /><br />
			<label class="label">Mensagem</label><br>
			<textarea name="mensagemremetente" rows="5" cols="60"></textarea>  <br/><br/>
			<input type="submit" value="Enviar">
		</form>

	</div>

</div> <!-- container -->

<?php include_once "final.inc.php" ?>
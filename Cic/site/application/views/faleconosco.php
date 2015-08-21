<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1>Fale com o CIC</h1><br>
		<?php if (validation_errors()) { ?>
		<div class="msgErro"><?php echo validation_errors(); ?></div><br>
		<?php }  ?>
		<?php if ($form['sucesso']) { ?>
		<div class="msgOk"><?php echo $form['sucesso']; ?></div><br>
		<?php }  ?>
		<form class="camposFormulario" method="post" action="<?php echo base_url()?>faleconosco/enviar">
			<label class="esq" for="para" style="font-size: 12px">Falar com</label><br> 
			<select name="para">
				<?php foreach($funcoes as $funcaoRow): ?>
				<option value="<?php echo $funcaoRow['email']?>" <?php if($form['para'] == $funcaoRow['email']) echo "selected"; ?>><?php echo $funcaoRow['nome']?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<label class="esq" for="nome" style="font-size: 12px">Nome</label><br>
			<div id="input"><span><input name="nome" value="<?php echo $form['nome']?>" type="text" style="width: 250px;" /></span></div>
			<label class="esq" for="email" style="font-size: 12px">E-mail</label><br>
			<div id="input" ><span><input name="email" value="<?php echo $form['email']?>" type="text" style="width: 250px;" /></span></div>
			<label class="esq" for="assunto" style="font-size: 12px">Assunto</label><br>
			<div id="input" ><span><input name="assunto" value="<?php echo $form['assunto']?>" type="text" style="width: 300px" /></span></div>
			<label class="esq" for="mensagem" style="font-size: 12px">Mensagem</label><br>
			<textarea class="textearea" name="msg" cols="95" rows="10"><?php echo $form['msg']?></textarea> <br>
			<input class="esq" style="margin: 10px 10px" type="image" src="<?php echo base_url() ?>site/img/enviar.gif" />
		</form>
	<!--  -->
	</div><br/>
	<h2><b>Nosso Endereço</b></h2>
	<p>Casa da Indústria. Av. Barão de Studart, 1980 5º Andar<br/>
	Aldeota - Fortaleza - Ceará - Brasil  CEP: 60120-001<br/>
	Fone/Fax: 85.3261.9612/3421.5412<br/>
	E-mail: <a href= "mailto:cic@cic.com.br" >cic@cic.com.br</a>
</p>
	</div>

<?php include "final.inc.php" ?>
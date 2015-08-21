<!-- CONTEUDO -->
<script type="text/javascript" language="javascript">
	function mostrar() {
		obj1 = document.getElementById("fild1");
		if (obj1.style.display=='none') {
			obj1.style.display='block';
		} else {
			obj1.style.display='none';
		}
	}
</script>
<div id="divConteudo">
	<h1 class="titulo">Consultoria Gratuita</h1>
	<div class="divisa"></div>
	<h1>Nossos Consultores</h1>
		<p align="center" style="background-color: #EEEEEE; margin: 5px; padding:10px 0 10px 0;">
		<a href="<?= base_url()?>consultores/letra/A">A</a>
		<a href="<?= base_url()?>consultores/letra/B">B</a>
		<a href="<?= base_url()?>consultores/letra/C">C</a>
		<a href="<?= base_url()?>consultores/letra/D">D</a>
		<a href="<?= base_url()?>consultores/letra/E">E</a>
		<a href="<?= base_url()?>consultores/letra/F">F</a>
		<a href="<?= base_url()?>consultores/letra/G">G</a>
		<a href="<?= base_url()?>consultores/letra/H">H</a>
		<a href="<?= base_url()?>consultores/letra/I">I</a>
		<a href="<?= base_url()?>consultores/letra/J">J</a>
		<a href="<?= base_url()?>consultores/letra/K">K</a>
		<a href="<?= base_url()?>consultores/letra/L">L</a>
		<a href="<?= base_url()?>consultores/letra/M">M</a>
		<a href="<?= base_url()?>consultores/letra/N">N</a>
		<a href="<?= base_url()?>consultores/letra/O">O</a>
		<a href="<?= base_url()?>consultores/letra/P">P</a>
		<a href="<?= base_url()?>consultores/letra/Q">Q</a>
		<a href="<?= base_url()?>consultores/letra/R">R</a>
		<a href="<?= base_url()?>consultores/letra/S">S</a>
		<a href="<?= base_url()?>consultores/letra/T">T</a>
		<a href="<?= base_url()?>consultores/letra/U">U</a>
		<a href="<?= base_url()?>consultores/letra/V">V</a>
		<a href="<?= base_url()?>consultores/letra/X">X</a>
		<a href="<?= base_url()?>consultores/letra/Y">Y</a>
		<a href="<?= base_url()?>consultores/letra/Z">Z</a>
	</p>
	<div align="right" style="padding-right: 5px">
		<form  action="<?=base_url()?>consultores/buscar/" method="post">
			<p>Buscar consultor
			<input type="text" size="15" name="search" value="<?= $_POST['search']?>" style="width:135px;">&nbsp;&nbsp;
			<input type="submit" value="Ok" style="cursor:pointer;"><br><br>
			</p>
		</form>
		<?php if ($_POST['search'] || $row['nome']){
		 		foreach ($consultores as $row) {
					$count++;
		 		}
		?>
		<p align="center" style="padding-left: 10px;">
		 Você pesquisou por: <b><?php echo $_POST['search']?></b> - total de <b><?= $count?></b> palavras encontradas
		</p>
		<? } ?>
</div>
	<?php if (!$consultor || $_POST['search']){?>
		<?php 
			if ($consultores) { 
			foreach ($consultores as $row){
		?>
			<p><a href="<?= base_url()?>consultores/ver/<?= $row['id']?>" ><?= highlight($row['nome'],$_POST['search'])?></a></p>
		<?php }	}?>
	<?php }	 else {?>
		<fieldset class="branco">
			<legend>Currículo</legend>
			<?php foreach ($consultor as $row){?>
				<p><?= $row['nome']?></p>
				<p><?= $row['curriculo']?></p>
			<?php }	?>
		</fieldset>
	<?php } 	?>	
<? echo "</br></br>$pag</br></br>";?>
</div>


<div id="divConteudo">
	<h1 class="titulo">Dicionário de Negócio</h1>
<div class="divisa"></div>
<p align="center" style="background-color: #EEEEEE; margin: 5px; padding:10px 0 10px 0;">
<a href="<?php echo  base_url()?>dicionario/letra/A">A</a>
<a href="<?php echo  base_url()?>dicionario/letra/B">B</a>
<a href="<?php echo  base_url()?>dicionario/letra/C">C</a>
<a href="<?php echo  base_url()?>dicionario/letra/D">D</a>
<a href="<?php echo  base_url()?>dicionario/letra/E">E</a>
<a href="<?php echo  base_url()?>dicionario/letra/F">F</a>
<a href="<?php echo  base_url()?>dicionario/letra/G">G</a>
<a href="<?php echo  base_url()?>dicionario/letra/H">H</a>
<a href="<?php echo  base_url()?>dicionario/letra/I">I</a>
<a href="<?php echo  base_url()?>dicionario/letra/J">J</a>
<a href="<?php echo  base_url()?>dicionario/letra/K">K</a>
<a href="<?php echo  base_url()?>dicionario/letra/L">L</a>
<a href="<?php echo  base_url()?>dicionario/letra/M">M</a>
<a href="<?php echo  base_url()?>dicionario/letra/N">N</a>
<a href="<?php echo  base_url()?>dicionario/letra/O">O</a>
<a href="<?php echo  base_url()?>dicionario/letra/P">P</a>
<a href="<?php echo  base_url()?>dicionario/letra/Q">Q</a>
<a href="<?php echo  base_url()?>dicionario/letra/R">R</a>
<a href="<?php echo  base_url()?>dicionario/letra/S">S</a>
<a href="<?php echo  base_url()?>dicionario/letra/T">T</a>
<a href="<?php echo  base_url()?>dicionario/letra/U">U</a>
<a href="<?php echo  base_url()?>dicionario/letra/V">V</a>
<a href="<?php echo  base_url()?>dicionario/letra/X">X</a>
<a href="<?php echo  base_url()?>dicionario/letra/Y">Y</a>
<a href="<?php echo  base_url()?>dicionario/letra/Z">Z</a>
</p>
<div align="right" style="padding-right: 5px">
		<form  action="<?php echo base_url()?>dicionario/buscar/" method="post">
			<p>Busca
			<input type="text" size="15" name="search" value="<?php echo  $_POST['search']?>" style="width:135px;">&nbsp;&nbsp;
			<input type="submit" value="Ok" style="cursor:pointer;"><br><br>
			</p>
		</form>
		<?php if ($_POST['search'] || $row['palavra'] || $row['significado']){
		 		foreach ($dicionario as $row) {
					$count++;
		 		}
		?>
		<p align="center" style="padding-left: 10px;">
		 Você pesquisou por: <b><?php echo $_POST['search']?></b> - total de <b><?php echo $count?></b> palavras encontradas
		</p>
		<?php }?>
</div>
	
<div style="padding-left: 50px">
	<?php foreach ($dicionario as $row) {?>
		<p>
		<a href='#nogo' onmouseout="ocultarPalavra();" onmouseover="exibirPalavra(<?php echo $row['id']?>, '<?php echo base_url()?>', this, '<?php echo $_POST['search']?>')">
		<?php echo  highlight($row['palavra'], $_POST['search']) ?>
		</a>
		</p>
	<?php } ?>
</div>		

</div>

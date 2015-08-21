<!-- CONTEUDO -->
<script type="text/javascript" language="javascript">
	function mostrar(id) {
		obj1 = document.getElementById(id);
		if (obj1.style.display=='none') {
			obj1.style.display='block';
		} else {
			obj1.style.display='none';
		}
	}
</script>
<div id="divConteudo">
	<h1 class="titulo">Artirculistas</h1>
	<div class="divisa"></div>
	<h1>Nossos Articulistas</h1>
		<p align="center" style="background-color: #EEEEEE; margin: 5px; padding:10px 0 10px 0;">
		<a href="<?php echo base_url()?>autores/letra/A">A</a>
		<a href="<?php echo  base_url()?>autores/letra/B">B</a>
		<a href="<?php echo  base_url()?>autores/letra/C">C</a>
		<a href="<?php echo  base_url()?>autores/letra/D">D</a>
		<a href="<?php echo  base_url()?>autores/letra/E">E</a>
		<a href="<?php echo  base_url()?>autores/letra/F">F</a>
		<a href="<?php echo  base_url()?>autores/letra/G">G</a>
		<a href="<?php echo  base_url()?>autores/letra/H">H</a>
		<a href="<?php echo  base_url()?>autores/letra/I">I</a>
		<a href="<?php echo  base_url()?>autores/letra/J">J</a>
		<a href="<?php echo  base_url()?>autores/letra/K">K</a>
		<a href="<?php echo  base_url()?>autores/letra/L">L</a>
		<a href="<?php echo  base_url()?>autores/letra/M">M</a>
		<a href="<?php echo  base_url()?>autores/letra/N">N</a>
		<a href="<?php echo  base_url()?>autores/letra/O">O</a>
		<a href="<?php echo  base_url()?>autores/letra/P">P</a>
		<a href="<?php echo  base_url()?>autores/letra/Q">Q</a>
		<a href="<?php echo  base_url()?>autores/letra/R">R</a>
		<a href="<?php echo  base_url()?>autores/letra/S">S</a>
		<a href="<?php echo  base_url()?>autores/letra/T">T</a>
		<a href="<?php echo  base_url()?>autores/letra/U">U</a>
		<a href="<?php echo  base_url()?>autores/letra/V">V</a>
		<a href="<?php echo  base_url()?>autores/letra/X">X</a>
		<a href="<?php echo  base_url()?>autores/letra/Y">Y</a>
		<a href="<?php echo  base_url()?>autores/letra/Z">Z</a>
	</p>
	<div align="right" style="padding-right: 5px; height: 15px">
		<form  action="<?php echo base_url()?>autores/buscar/" method="post">
			<p>Buscar articulistas
			<input type="text" size="15" name="search" value="<?php echo $_POST['search']?>" style="width:200px;">&nbsp;&nbsp;
			<input type="submit" value="Ok" style="cursor:pointer;"><br><br>
			</p>
		</form>
		<?php if ($_POST['search'] || $row['nome']){
		 		foreach ($autores as $row) {
					$count++;
	 	 		}
		?>
		<p align="center" style="padding-left: 10px;">
		 Você pesquisou por: <b><?php echo $_POST['search']?></b> - total de <b><?php echo  $count?></b> palavras encontradas
		</p>
		<?php } ?>
	</div>
	<h1><?php echo $letra?></h1>
	<?php if ($autores || $_POST['search']){
				//$qtdArtigos = 0;
				foreach ($autores as $rowA){?>
					<?php if ($rowA['nome'] != $nomeAnterior){ ?>
					<p><a href="<?php echo base_url()?>autores/verAutor/<?php echo $rowA['idAutores']?>"><?php echo highlight($rowA['nome'],$_POST['search'])?> <span style="color: #666666">[<?php echo $rowA['qtdArtigos']?> artigo(s)]</span></a></p>
					<?php }?>
					<!-- <p style="font-size: 10px"><a href="<?=base_url()?>artigos/ver/<?=$rowA['id']?>"><?=$rowA['titulo']?></a></p>-->
			<?php 		$nomeAnterior = $rowA['nome'];
				}
			}
	?>
<?php //echo "</br></br>$pag</br></br>";?>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<!-- CONTEÚDO -->
<div id="divConteudo">
		<h1 class="titulo">Trabalhos Acadêmicos</h1>
		<div class="divisa"></div>
		<ul class="listagem">
		<script>
			function mostrar(id) {
				obj1 = document.getElementById(id);
				if (obj1.style.display=='block') {
					obj1.style.display='none';
				} else {
					obj1.style.display='block';
				}
			}
		</script>
		<?php
		if ($trabalho) {
			foreach ($trabalho as $row){
				$arquivo = base_url()."site/trabalhos/".$row['arquivo'];
				$tamanho = get_file_info('./site/trabalhos/'.$row['arquivo']);
				$tamanho = round($tamanho['size'] / 1024,2);
		?>
		<li>
				<h1>
					
					<!--  <a href="<?php echo $arquivo ?>" target="_blank" ><?php echo $row['titulo']?></a>-->
					<a style="cursor: pointer;" onclick="mostrar(<?php echo $row['id']?>);"><?php echo $row['titulo']?></a>
				</h1>
				<div id="<?php echo $row['id']?>" style="display: none">
					
					<p><small><?php echo $row['resumo']?></small></p>
					<?php if ($row['autor']) {?>
					<p><b>Autores: </b><br><small><?php echo $row['autor']?></small></p>
					<?php }?>
					<?php if ($row['orientador']) { ?>
					<p><b>Orientador: </b> <br><small><?php echo $row['orientador']?></small></p>
					<?php }?>
					<?php if ($arquivo) { ?>
						<br /><p><img src="<?php echo base_url()?>site/img/down.png" border="0">
						<a href="<?php echo $arquivo ?>" target="_blank" ><small>Download [ <?php echo $tamanho?>k ]</small></a></p>
					<?php } ?>
				</div>	
		</li>
		<?php }	} ?>	
		</ul>
</div>

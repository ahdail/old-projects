<!-- CONTEUDO -->

<div id="divConteudo">
	<h1 class="titulo">Articulistas</h1>
	<div class="divisa"></div>
	<h1><?php echo $nomeAutor?> </h1>
	
	<h2>Todos os meus artigos publicados no Portal da Classe Contábil</h2>	
	<fieldset>
		<table align="center" width="100%">
			<?php foreach ($autor as $row){?>
			<tr>
				<td><a href="<?php echo base_url()?>artigos/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?> - (<?php echo sqlToDate($row['data'])?>)</a></td>
			</tr>
			<?php 
			}
			?>
		</table>
	</fieldset>
	
	<p align="center"><a href="<?php echo base_url()?>autores">Ver todos os Articulistas</a></p>
</div>


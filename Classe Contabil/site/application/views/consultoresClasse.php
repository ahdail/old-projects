<!-- CONTEUDO -->

<div id="divConteudo">
	<h1 class="titulo">Consultoria Gratuita</h1>
	<div class="divisa"></div>
	<h1>Nossos Consultores</h1>
	<?php if (!$estado){?>
	<h2>Lista de consultores cadastrados e credenciados no Portal da Classe Contábil</h2>	
	<fieldset>
		<table align="center" width="100%">
			<tr>
				<td align="center"><b>UF</b></td>
				<td><b>Estado</b></td>
				<td align="center"><b>Total</b></td>
			</tr>
			<?php foreach ($consultores as $row){?>
			<tr>
				<td align="center" style="border-bottom: 1px dotted #000000"><a href="<?= base_url()?>consultores/estado/<?=$row['estado']?>"><?=$row['estado']?></a></td>
				<td style="border-bottom: 1px dotted #000000"><a href="<?= base_url()?>consultores/estado/<?=$row['estado']?>"><?=$row['NOME']?></a></td>
				<td align="center" style="border-bottom: 1px dotted #000000"><?=$row['total']?></td>
			</tr>
			<?php 
			}
			?>
		</table>
	</fieldset>
		
	<?php } else {?>
	<h2>Lista por Estado</h2>	
	<fieldset>
		<table align="center" width="100%">
			<tr>
				<td><b>Consultor</b></td>
				<td><b>Email</b></td>
				<td><b>Ocupação</td>
				<td><b>Cidade</b></td>
			</tr>
			
			<?php foreach ($consultores as $row){?>
			<tr>
				<td><a href="<?= base_url()?>consultores/ver/<?= $row['id']?>"><?=$row['nome']?></a></td>
				<?php 
					$imagem = base_url()."site/img/arroba.gif";
					$img = "<img src=\"$imagem\" alt=\"@\" />"
				?>
				<td><?= str_replace('@', $img, $row['email']); ?></td>
				<td><?=$row['cargo']?></td>
				<td><?=$row['m_nome']?></td>
			</tr>
			<?php }?>
		</table>
	</fieldset>
	<?php }?>
	<p align="center"><a href="<?= base_url()?>consultores/listar">Todos os Consultores (<?=$totalConsultores?>)</a></p>
</div>


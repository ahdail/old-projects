<?php include "inicio.inc.php" ?>
<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO > TIRA DA ESQUERDA -->
	
	<div>
	<h1>Agenda Anual - Eventos do CIC </h1>
	<?php foreach ($meses as $mesRow) {?>
		<h2><b><?php echo $mesRow['mes']?></b></h2>
		<?php foreach($mesRow['eventos'] as $eventoRow) {?>
		<p style="padding-left: 15px">
		<?php if($eventoRow['descricao']){ ?>
			<a class="preto" href="<?php echo base_url() ?>agenda/evento/<?php echo $eventoRow['id']?>">
				<?php echo sqlToDate($eventoRow['data']);?> &#8211; <?php echo $eventoRow['titulo'] ?>
			</a>
		<?php } else {?>
				<?php echo sqlToDate($eventoRow['data']);?> &#8211; <?php echo $eventoRow['titulo'] ?>
		<?php }?>
		</p>
		<?php	
		}
	}
	?>
	</div>
</div>

<?php include "final.inc.php" ?>
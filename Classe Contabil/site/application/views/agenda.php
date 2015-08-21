<!-- CONTEÚDO -->
<div id="divConteudo">
<h1 class="titulo">Agenda anual de eventos</h1>
<div class="divisa"></div>
<ul class="listagem">
	<li>
	<?php foreach ($meses as $mesRow) {?>
		<h1><?php echo $mesRow['mes']?></h1>
		<?php foreach($mesRow['eventos'] as $eventoRow) {?>
		<p style="padding-left: 15px;line-height: 20px;">
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
	
	</li>
</ul>
</div>

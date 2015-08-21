<!-- FAQ -->
<div id="divConteudo">
<!-- FAQ (Frequently Asked Questions) -->	
	<h1 class="titulo">Perguntas Frenquentes</h1>
	<div class="divisa"></div>
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
	<?php foreach ($faq as $row){?>
		<ul class="listagem">
			<li>
				<h1><a style="cursor: pointer;" onclick="mostrar(<?php echo $row['id']?>);"><?php echo $row['pergunta']?></a></h1>
				<div id="<?php echo $row['id']?>" style="display: none">
					<p><?php echo nl2br($row['resposta'])?></p>
				</div>
			</li>
		</ul>
	<?php }?>
	
</div>

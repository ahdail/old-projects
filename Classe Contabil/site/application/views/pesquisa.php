
<?php checkLogin($session_email);?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
<!-- CONTEÚDO -->
<div id="divConteudo">
		<h1 class="titulo">Pesquisas</h1>
		<div class="divisa"></div>
		<ul class="listagem">
		<?php
		if ($pesquisa) {
			foreach ($pesquisa as $row){
		?>
			<li>
				<h1><a href="<?=base_url()?>pesquisas/exibirPerguntas/<?=$row['id']?>/<?=$row['qtdPerguntas']?>"><?=$row['pesquisa']?></a></h1>
			</li>
		<?php }
		}
		else { ?>
			<br />
			<div class="msgErro" style="padding-left: 10px">Nenhuma pesquisa disponível no momento.</div>	
		<?php } ?>
		</ul>
<? echo "</br></br>$pag</br></br>";?>	
</div>

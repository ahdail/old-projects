
<?php
// Se o usuario estiver logado ele poderá comentar a noticia, 
// senão será redirecionado para fazer o login no sistema.
if ($session_email){
	$linkComentar = "javascript:comentar();";
	$linkComentarTopo = "#ancoraComentar";
	$linkEnviarEmailTopo = "#ancoraEnviar";
	$linkEnviarEmail = "javascript:indicar();";
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkComentar = base_url()."login";
	$linkEnviarEmail = base_url()."login";
	$linkComentarTopo = $linkComentar;
	$linkEnviarEmailTopo = $linkEnviarEmail;
}
?>
<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Contábil" href="<?php echo base_url()?>noticias/rss" />
<!-- CONTEÚDO -->
<div id="divConteudo">
	<?php if ($noticia['id']){?>
	<h1 class="titulo">Notícias</h1>
	<div id="divOpcoes">
		<?php 
			$dataNoticia = sqlToDate($noticia['data']);
		?>
		<span id="data" class="esq"><?= $dataNoticia?></span>
		<span id="opcoes" class="dir">
			<ul>
				<li id="imprimir"><a href="<?php echo base_url()?>imprimir/noticia/<?php echo $noticia[id]?>" target="_blank">Imprimir</a></li>
				<li id="comentar"><a href="<?php echo $linkComentarTopo?>">Comentar</a></li>
				<li id="enviar"><a href="<?php echo $linkEnviarEmailTopo ?>" onclick="javascript:indicar();">Enviar por e-mail</a></li>
				<li id="tamanho">Tamanho da letra 
					<a href="javascript:ts('corpo' , -1);"><img src="<?php echo base_url()?>site/img/tamanhoAzinho.gif" title="Diminuir letra" /></a>
					<a href="javascript:ts('corpo', 1);"><img src="<?php echo base_url()?>site/img/tamanhoAzao.gif" title="Aumentar letra" /></a>
				</li>
			</ul>
		</span>
	</div>
		<h1><?php echo $noticia['titulo'] ?></h1>
		<div id="corpo"><p><?php echo inserirTags($noticia['conteudo'])?></p></div>
		<?php 
		if ($noticia['fonte']){
			$fonte = $noticia['nomeFonte'];
			$siteFonte = $noticia['siteFonte'];
			if ($siteFonte == "-"){
				$var = "# ";
			} else {
				$var = " href=\"$siteFonte\" ";
			}
		?> 
			<a class="fonte" <?php echo $var?> target="_blank">Fonte: <?php echo $fonte?></a>
		<?php } ?>
		<a name="ancoraComentar"> </a><a name="ancoraEnviar"> </a>
		<div id="divOpcoes">
			<span id="opcoes" class="esq">
				<ul>
					<li id="imprimir"><a href="<?php echo base_url()?>imprimir/noticia/<?php echo $noticia[id]?>" target="_blank">Imprimir</a></li>
					<li id="comentar"><a href="<?php echo $linkComentar?>">Comentar</a></li>
					<li id="enviar"><a href="<?= $linkEnviarEmail ?>">Enviar por e-mail</a></li>
				</ul>
			</span>
		</div>
		
		<!-- SCRIPT AJAX PARA OS COMENTÁRIOS E INDICAÇÕES -->
		<script language="javascript" type="text/javascript">
		$(document).ready(function() { 
			var opcoes = {
				beforeSubmit: function () {
					$("#comentarForm").html("<div class='msgNormal'>Enviando...</div>");
				},
				success: function (retorno) {
					$("#comentarForm").html(retorno);
				}
			} 
			$('#formComentario').ajaxForm(opcoes);
		});
		</script>
		<script>
		$(document).ready(function() { 
			var opcoes = {
				beforeSubmit: function () {
					$("#indicarForm").html("<div class='msgNormal'>Enviando...</div>");
				},
				success: function (retorno) {
					$("#indicarForm").html(retorno);
				}
			} 
			$('#formIndicacao').ajaxForm(opcoes);
		});
		</script>

		<!-- Exibir o Formulário de indicacao de notícia -->
		<form action="<?php echo base_url()?>noticias/indicacao/<?php echo $idNoticia?>" method="post" id="formIndicacao">
			<?php if($session_idUsuario){?>
			<input type="hidden" name="nomerem" value="<?php echo $session_login?>">
			<input type="hidden" name="emailrem" value="<?php echo $session_email?>">
			<?php } ?>
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
		<!-- Exibir o Formulário de comentário -->
		<form action="<?php echo base_url()?>noticias/comentar/<?php echo $idNoticia?>" method="post" id="formComentario">
			<?php if($session_idUsuario){?>
			<input type="hidden" name="nome" value="<?php echo $session_login?>">
			<input type="hidden" name="email" value="<?php echo $session_email?>">
			<?php } ?>
			<div id="comentarForm">
			<?php
				if ($session_email) echo $comentario;
			?>
			</div>
		</form>
		<!-- Exibir comentários -->
		<?php if($exibirComentarios){?>
		<ul class="relacionados listComent"><h1>Comentários</h1>
			<?php
				if ($exibirComentarios){
					foreach ($exibirComentarios as $row){
						echo "
							<li>
								<span>$row[nome] comentou:</span>
								<p>$row[comentario]</p>
							</li>
						";
					}
				}
			?>
			<a id="todos" href="<?php echo base_url()?>comentarios/noticia/<?php echo $noticia[id]?>">Ver todos os comentários</a>
		</ul>
		<?php }?>
		<!-- / -->
		<ul class="relacionados"><h1>Notícias Relacionadas</h1>
			<?php 
				if ($noticiasRelacionadas){
					foreach ($noticiasRelacionadas as $row){
						$dataNoticiaPrincipal = sqlToDate($row['data']);
						$base_url= base_url();
						
						if ($row['tags'] == 0) {
							$tags = "Nenhuma tag relacionada";	
						} else if ($row['tags'] == 1) {
							$tags = '1 Tag relacionada';
						} else {
							$tags = $row['tags'].' Tags relacionadas';
						}
						echo "
							<li>
								<a href=\"$base_url noticias/ver/$row[id]\" title='{$tags}'><span>$dataNoticiaPrincipal</span> $row[titulo]</a>
							</li>
						";
					}
				}
				?>
		</ul>
		<!-- Últimas Notícias  -->
		<ul class="relacionados"><h1>Últimas Notícias</h1>
			<?php 
				if ($ultimas3Noticias){
					foreach ($ultimas3Noticias as $row){
						$dataNoticiaPrincipal = sqlToDate($row['data']);
						$base_url= base_url();
						echo "
							<li>
								<a href=\"$base_url noticias/ver/$row[id]\"><span>$dataNoticiaPrincipal</span> $row[titulo]</a>
							</li>
						";
					}
				}
				?>
	</ul>
	<br />
<!-- Listagem de todas as Notícias -->	
<?php } else { ?>
		<h1 class="titulo">Todas as Notícias</h1>
		<div class="divisa"></div>
		<ul class="listagem">
		<?php
		foreach ($noticias as $row){
		$dataNoticia = sqlToDate($row['data']);
		?>
			<li>
					<p class="data">
					<?php echo $dataNoticia?><br /><?php echo $row['acesso']?> acessos
					<?php if ($row['comentarios']){?>
						<br /><?php echo $row['comentarios']?> comentário(s)
					<?php }?>
					</p>
					<h1><a href="<?php echo base_url()?>noticias/ver/<?php echo $row[id]?>"><?php echo $row['titulo']?></a></h1>
					<p><?php echo inserirTags($row['resumo'])?></p>
			</li>
		<?php }	
		echo"</ul>";	
 }?>
<?php echo "<br /><br />$pag
	 <p align=center>$qtd de $total</p>";
?>
</div>

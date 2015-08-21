<?php

// Checkar variavel na session
if ($validaUsuario == "false"){
redirect('', 'location');
//echo $validaUsuario;
}
?>
<?php
// Se o usuario estiver logado ele poderá comentar a noticia, 
// senão será redirecionado para fazer o login no sistema.
if ($session_email){
	$linkComentar = "javascript:comentar();";
	$linkComentarTopo = "#ancoraComentar";
	$linkIndicacao = "javascript:indicar();";
	$linkIndicacaoTopo = "#ancoraEnviar";
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkComentar = base_url()."login";
	$linkIndicacao = base_url()."login";
	$linkComentarTopo = $linkComentar;
	$linkIndicacaoTopo = $linkIndicacao;
}
?>
<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Contábil" href="<?php echo base_url()?>artigos/rss" />
<!-- CONTEÚDO -->
<div id="divConteudo">
	<?php  
	if ($artigo['id']){
		if($artigo['tipo'] == "A"){
			$nome = "Artigo";
		} else {
			$nome = "Temas de Direito Empresarial";
		}
	?>
	
	<h1 class="titulo"><?php echo $nome?></h1>
	<div id="divOpcoes">
		<?php $dataArtigo = sqlToDate($artigo['data']);	?>
		<span id="data" class="esq"><?php echo $dataArtigo ?></span>
		<span id="opcoes" class="dir">
			<ul>
				<li id="imprimir"><a href="<?php echo base_url()?>imprimir/artigo/<?php echo $artigo[id]?>" target="_blank">Imprimir</a></li>
				<?php if ($artigo['tipo'] != "D") {?>
				<li id="comentar"><a href="<?php echo $linkComentarTopo?>">Comentar</a></li>
				<?php }?>
				<li id="enviar"><a href="<?php echo $linkIndicacaoTopo ?>" onclick="javascript:indicar();">Enviar por e-mail</a></li>
				<li id="tamanho">Tamanho da letra
					<a href="javascript:ts('corpo', -1);"><img src="<?php echo base_url()?>site/img/tamanhoAzinho.gif" title="Diminuir letra" /></a>
					<a href="javascript:ts('corpo', 1);"><img src="<?php echo base_url()?>site/img/tamanhoAzao.gif" title="Aumentar letra" /></a> 
				</li>
			</ul>
		</span>
	</div>
	<h1><?php echo $artigo['titulo'] ?></h1>
	<div id="corpo"><p><?php echo inserirTags($artigo['conteudo'])?></p></div>
	<?php 
	if ($artigo['idAutores']){
		$idAutor = $artigo['idAutor'];?> 
		<a class="fonte" href="javascript:mostrar();">Autor: <?php echo $autor[nome]?></a>
		<div id="autor">
			<?php echo $autor['curriculoResumido'] ?>
		</div>
	<?php }?>
	<a name="ancoraComentar"> </a><a name="ancoraEnviar"> </a>
	<div id="divOpcoes">
		<span id="opcoes" class="esq">
			<ul>
				<li id="imprimir"><a href="<?php echo base_url()?>imprimir/artigo/<?php echo $artigo[id]?>" target="_blank">Imprimir</a></li>
				<?php if($artigo['tipo'] != "D") {?>
				<li id="comentar"><a href="<?php echo $linkComentar?>">Comentar</a></li>
				<?php }?>
					<li id="enviar"><a href="<?php echo $linkIndicacao ?>">Enviar por e-mail</a></li>
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
	<form action="<?php echo base_url()?>artigos/indicacao/<?php echo $idArtigo?>" method="post" id="formIndicacao">
		<?php if($session_idUsuario){?>
		<input type="hidden" name="nome" value="<?php echo $session_login?>">
		<input type="hidden" name="email" value="<?php echo $session_email?>">
		<?php } ?>
		<div id="indicarForm">
		<?php 
			echo $indicacao;
		?>
		</div>
	</form>
	<!-- Exibir o Formulário de comentário -->
	<form action="<?php echo base_url()?>artigos/comentar/<?php echo $idArtigo?>" method="post" id="formComentario">
		<?php if($session_idUsuario){?>
		<input type="hidden" name="nome" value="<?php echo $session_login?>">
		<input type="hidden" name="email" value="<?php echo $session_email?>">
		<?php } ?>
		<div id="comentarForm">
		<?php 
			echo $comentario;
		?>
		</div>
	</form>
	<!-- Exibir comentários -->
	<?php if($exibirComentarios){?>
	<ul class="relacionados listComent"><h1>Comentário(s)</h1>
		<?php
			if ($exibirComentarios){
				foreach ($exibirComentarios as $row) {
					echo "
						<li>
							<span>$row[nome] comentou:</span>
							<p>$row[comentario]</p>
						</li>
					";
				}
			}
		?>
		<a id="todos" href="<?php echo base_url()?>comentarios/artigo/<?php echo $artigo[id]?>">Ver todos os comentários</a>
	</ul>
	<?php }?>
	<!--  -->
	<ul class="relacionados"><h1>Últimos Artigos</h1>
			<?php 
				if ($ultimos3Artigos){
					foreach ($ultimos3Artigos as $row){
						$dataArtigoPrincipal = sqlToDate($row['data']);
						$base_url= base_url();
						echo "
							<li>
								<a href=\"$base_url artigos/ver/$row[id]\"><span>$dataArtigoPrincipal</span> $row[titulo]</a>
							</li>
						";
					}
				}
				?>
	</ul>
	<br />
	
<!-- Listagem de todos os Artigos -->	
<?php } else { ?>
		<h1 class="titulo"><?php echo $secao?></h1>
		<div class="divisa"></div>
		<ul class="listagem">
		<?php
		foreach ($artigos as $row){
		$dataArtigo = sqlToDate($row['data']);
			echo $row['qdtComentarios'];
		?>
			<li>
				<p class="data"><?php echo $dataArtigo?><br /><?php echo $row['acesso']?> acessos
				<?php if ($row['comentarios']){?>
					<br /><?php echo $row['comentarios']?> comentário(s)
				<?php }?>
				</p>
				<h1><a href="<?php echo base_url()?>artigos/ver/<?php echo$row[id]?>"><?php echo $row[titulo]?></a></h1>
				<p><?=$row[resumo]?></p>
			</li>
		<?php }	
		echo"</ul>";	
 }?>

<?php echo "<br /><br />$pag
	 <p align=center>$qtd de $total</p>";
?>
</div>

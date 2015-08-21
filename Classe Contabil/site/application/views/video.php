<?php 
if ($session_email){
	$linkComentar = "javascript:comentar();";
	$linkComentarTopo = "#ancoraComentar";
	$linkIndicacao = "javascript:indicar();";
	$linkIndicacaoTopo = "#ancoraEnviar";
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkComentar = base_url()."login";
	$linkComentarTopo = $linkComentar;
	$linkIndicacao = base_url()."login";
	$linkIndicacaoTopo = $linkIndicacao;
}
?>
<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Contábil" href="<?php echo base_url()?>videos/rss" />
<!-- CONTEUDO -->
<div id="divConteudo">
	<!-- CONTEUDO CENTRAL -->
	
	<h1 class="titulo">Vídeos Classe</h1>
	<div id="divOpcoes">
		<span class="esq"><h3 style="padding-left: 15px;"><?php echo $rowVideo['titulo'] ?></h3></span>
	</div>
	<br />
	<div>
		<p class="meio" style="padding-left: 15px;">
		<embed class="meio"
			src="<?php echo base_url() ?>site/videos/videoplayer.swf"
			width="600"
			height="450"
			allowscriptaccess="always"
			allowfullscreen="true"
			flashvars="file=<?php echo base_url()?>site/videos/<?php echo $rowVideo['arquivo']?>"/>
		</embed><br /><br />
		<span><?php echo $rowVideo['resumo']?></span>
		<p class="dir" style="padding-right: 20px"><a class="mais" href="<?php echo base_url()?>video/">ver todos &raquo;</a></p>
	</div>
	<div id="divOpcoes">
		<span id="opcoes" class="dir">
			<ul>
				<li id="comentar"><a href="<?php echo $linkComentar?>">Comentar</a></li>
				<li id="enviar"><a href="<?php echo $linkIndicacao ?>" onclick="javascript:indicar();">Enviar por e-mail</a></li>
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
		<form action="<?php echo base_url()?>video/indicacao/<?php echo $rowVideo['id'] ?>" method="post" id="formIndicacao">
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
		<!-- Exibir o Formulário de comentário -->
		<form action="<?php echo base_url()?>video/comentar/<?php echo $rowVideo['id'] ?>" method="post" id="formComentario">
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
		</ul>
		<?php }?>
		<!-- / -->
	
	
</div>
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
<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Contábil" href="<?php echo base_url()?>pod/rss" />
<!-- CONTEUDO -->
<div id="divConteudo">
	<!-- CONTEUDO CENTRAL -->
	
	<h1 class="titulo">Podcasting</h1>
	<div id="divOpcoes">
		<a href="<?php echo base_url()?>site/podclasse/<?php echo $rowPod['arquivo']?>" class="dir" style="margin-top: 10px" target="_BLANK"><img style="border: none" src="<?php echo base_url()?>site/img/down.png" alt="Baixe o podcast" style="vertical-align: middle" /> Salvar no computador</a>
		<embed style="margin-top: 7px"
			src="<?php echo base_url()?>site/podclasse/podcast.swf"
			width="230"
			height="24"
			flashvars="playerID=1&amp;bg=0xD0EBEA&amp;leftbg=0x01B8C0&amp;lefticon=0xFFFFFF&amp;rightbg=0x00CCC8&amp;righticon=0xFFFFFF&amp;soundFile=<?php echo base_url()?>site/podclasse/<?php echo $rowPod['arquivo']?>"/>
		</embed>
	</div>
	<h3><?php echo $rowPod['titulo'] ?></h3>
	<p><?php echo $rowPod['descricao']?></p>
	<p class="dir" style="padding-right: 20px"><a class="mais" href="<?php echo base_url()?>pod/">ver todos &raquo;</a></p>
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
		<form action="<?php echo  base_url()?>pod/indicacao/<?php echo $rowPod['id'] ?>" method="post" id="formIndicacao">
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
		<!-- Exibir o Formulário de comentário -->
		<form action="<?php echo base_url()?>pod/comentar/<?php echo $rowPod['id'] ?>" method="post" id="formComentario">
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


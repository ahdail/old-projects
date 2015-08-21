<?php 
// Se o usuario estiver logado ele poderá comentar, 
// senão será redirecionado para fazer o login no sistema.
if ($session_email){
	$linkComentar = "javascript:comentar();";
	$linkComentarTopo = "#ancoraComentar";
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkComentar = base_url()."login";
	$linkComentarTopo = $linkComentar;
}
?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
<!-- CONTEÚDO -->
<div id="divConteudo">
	<?php if ($neo['id']){?>
	<h1 class="titulo">Neopatrimonialismo</h1>
	<div id="divOpcoes">
		<?php 
			$dataNoticia = sqlToDate($neo['data']);
		?>
		<span id="data" class="esq"><?= $dataNoticia?></span>
		<span id="opcoes" class="dir">
			<ul>
				<li id="imprimir"><a href="<?= base_url()?>imprimir/neo/<?=$neo['id']?>" target="_blank">Imprimir</a></li>
				<li id="comentar"><a href="<?=$linkComentarTopo?>">Comentar</a></li>
				<li id="enviar"><a href="#ancoraEnviar" onclick="javascript:indicar();">Enviar por e-mail</a></li>
				<li id="tamanho">Tamanho da letra 
					<a href="javascript:ts('corpo' , -1);"><img src="<?= base_url()?>site/img/tamanhoAzinho.gif" title="Diminuir letra" /></a>
					<a href="javascript:ts('corpo', 1);"><img src="<?= base_url()?>site/img/tamanhoAzao.gif" title="Aumentar letra" /></a>
				</li>
			</ul>
		</span>
	</div>
		<h1><?= $neo['titulo'] ?></h1>
		<div id="corpo">
			<p style="padding-right: 10px"><?=$neo['conteudo']?><br><br></p>
			<p align="right" style="padding-right: 10px">&laquo; <a href="<?= base_url()?>neo" style="color: #464646">ver todos</a> &raquo;</p>
		</div>
		<a name="ancoraComentar"> </a><a name="ancoraEnviar"> </a>
		<div id="divOpcoes">
			<span id="opcoes" class="esq">
				<ul>
					<li id="imprimir"><a href="<?= base_url()?>imprimir/neo/<?=$neo['id']?>" target="_blank">Imprimir</a></li>
					<li id="comentar"><a href="<?=$linkComentar?>">Comentar</a></li>
					<li id="enviar"><a href="javascript:indicar();">Enviar por e-mail</a></li>
				</ul>
			</span>
		</div>
		
		<!-- SCRIPT AJAX PARA OS COMENTÁRIOS E INDICAÇÕES -->
		<script language="javascript" type="text/javascript">
		$(document).ready(function() { 
			var opcoes = {
				beforeSubmit: function () {
					$("#comentarForm").html("<p>Enviando...</p>");
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
					$("#indicarForm").html("<p>Enviando...</p>");
				},
				success: function (retorno) {
					$("#indicarForm").html(retorno);
				}
			} 
			$('#formIndicacao').ajaxForm(opcoes);
		});
		</script>
		
		<!-- Exibir o Formulário de indicacao de notícia -->
		<form action="<?= base_url()?>neo/indicacao/<?=$neo['id']?>" method="post" id="formIndicacao">
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
		<!-- Exibir o Formulário de comentário -->
		<form action="<?= base_url()?>neo/comentar/<?=$neo['id']?>" method="post" id="formComentario">
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
			<a id="todos" href="<?= base_url()?>comentarios/noticia/<?=$neo['id']?>">Ver todos os comentários</a>
		</ul>
		<?php }?>
		<!-- / -->
		<!--  
		<ul class="relacionados"><h1>Notícias Relacionadas</h1>
			<?php 
				if ($neosRelacionadas){
					foreach ($neosRelacionadas as $row){
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
		-->
		<!-- Últimos Neopatrimonialismo  -->
		<ul class="relacionados"><h1>Últimos Neopatrimonialismo</h1>
			<?php 
				if ($ultimas3){
					foreach ($ultimas3 as $row){
						$dataPrincipal = sqlToDate($row['data']);
						$base_url= base_url();
						echo "
							<li>
								<a href=\"$base_url neo/ver/$row[id]\"><span>$dataPrincipal</span> $row[titulo]</a>
							</li>
						";
					}
				}
				?>
	</ul>
	<br />
<!-- Listagem de todas as Notícias -->	
<?php } else { ?>
<div style="display: table; background-color: #EEEEEE; padding: 10px" >
	<p>
	<img src="http://www.classecontabil.com.br/i/cdb/14.jpg" style="float: right" title="Prof. Dr. Antônio Lopes de Sá">
	<b>O QUE É O NEOPATRIMONIALISMO</b><br>
		<p style="line-height: 20px;padding-right: 110px">
			"Chama-se Neopatrimonialismo uma nova idéia, apoiada em estudos que visam a AJUDAR A PENSAR em Contabilidade.<br>
			É um GUIA DO RACIOCINIO que visa a dar ordem ao raciocínio para entender tudo o que se relaciona com a riqueza das empresas e das instituições (que são células sociais).<br>
			É a primeira vez que na História do Brasil se reúnem milhares de adeptos de uma idéia de cunho científico." - (<a href="<?= base_url()?>neo/definicao" style="color: #464646">Clique aqui para ler o artigo completo</a>)<br>
		</p>
		<p style="padding-left: 310px; color:#008D79;">Prof. Dr. Antônio Lopes de Sá</p>
	</p>
</div><br>
		<h1 class="titulo">Neopatrimonialismo</h1>
		<div class="divisa"></div>
		<?php
		echo"<ul class=\"listagem\">";
		foreach ($neo as $row){
		$dataNeo = sqlToDate($row['data']);
		?>
			<li>
				<p class="data"><?=$dataNeo?><br />(<?= $row['acesso']?> acessos)</p>
				<h1><a href="<?= base_url()?>neo/ver/<?=$row['id']?>"><?=$row['titulo']?></a></h1>
				<p><?=$row['resumo']?></p>
			</li>
		<?php }	
		echo"</ul>";	
 }?>
<? echo "</br></br>$pag</br></br>";?>	
</div>

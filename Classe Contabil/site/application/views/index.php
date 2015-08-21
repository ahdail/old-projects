<?php 
// Se o usuario estiver logado ele poderá fazer pergunta, 
// senão, será redirecionado para fazer o login no sistema e depois retornará para perguntar.
if (!$session_idUsuario){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/inicial.css" />
<script language="javascript">
$(document).ready(function() { 
	var opcoes = {
		beforeSubmit: function () {
			$("#indicacao").html("<p>Enviando...</p>");
		},
		success: function (retorno) {
			$("#indicacao").html(retorno);
		}
	} 
	$('#formIndicacao').ajaxForm(opcoes);
});
</script>
<?php

$result = $this->UsuarioModel->verificaDados($session_idUsuario);
if (in_array("", $result)) {
	/*echo "
		<script>
			alert('Seu cadastro está incompleto. Por favor atualizar seus dados')
		</script>
	";*/
}

?>
<!-- CONTEUDO -->
<div id="divConteudo">
	<div id="divColunaEsq">
		<!-- CONTEUDO > Notícias -->
		<div class="quadroEsq">
			<div id="divTitulo">
				<h1>Notícias</h1>
				<a id="rss" href="<?php echo base_url()?>noticias/rss"><img src="<?php echo base_url()?>site/img/rss.gif" /> RSS</a>
				<select onchange="alternaNoticias();">
					<option selected="selected">Últimas</option>
					<option>Mais acessadas</option> 
				</select>
				<p>filtrar</p>
			</div>
			<ul id="notUltimas">
				<!-- Notícia Destaque -->
				<?php if ($noticiaDestaque){ ?>
				<li id="destaque">
				<?php
					foreach ($noticiaDestaque as $row){
						$caminho = base_url()."site/banners/".$row['icoDestaque'];
						if ($row['inserirImagem'] == "S") {
							$mostraImagem =  "
								<div class=\"esq\">
									<img src=\"$caminho\" width=76 height=71/>
								</div>
							";
						} else {
							$mostraImagem = "";
						}
						?>
							<a href="<?php echo base_url()?>noticias/ver/<?php $row['id']?>">
								<?php $mostraImagem?>
								<div>
									<h3><?php $row['titulo']?></h3>
									<p>
									<?php $row['resumo']?>
									
									<?php if ($row['comentarios']): ?>
									<br>
									<small style="text-align: right; display: block;"><?php $row['comentarios']?> comentários</small>
									<?php endif ?>
									</p>
								</div>
							</a>
						<?php
					}
				?>
				</li>
				<?php } ?>

				<!--  -->
				<!-- As três últimas notícias cadastradas -->
				<?php 
				if ($noticiasPrincipais){
					foreach ($noticiasPrincipais as $row){
						?>
						<li>
							<a href="<?php echo base_url()?>noticias/ver/<?php echo $row['id']?>">
								<h3><span><?php echo sqlToDateDiaMes($row['data'])?></span> <?php echo $row['titulo']?></h3>
								<p>
								<?php echo $row['resumo']?>
								
								<?php if ($row['comentarios']): ?>
								<br>
								<small style="text-align: right; display: block;"><?php echo $row['comentarios']?> comentários</small>
								<?php endif ?>
								</p>
							</a>
						</li>
						<?php
					}
				}
				?>
				<!--  -->
			</ul>
			<ul id="notMaisAcessados" style="display: none;">
				<?php 
				if ($noticiaAcessos){
					foreach ($noticiaAcessos as $row){
						?>
						<li>
							<a href="<?php echo base_url()?>noticias/ver/<?php echo $row['id']?>">
								<h3><span><?php echo sqlToDateDiaMes($row['data'])?></span> <?php echo $row['titulo']?></h3>
								<p>
								<?php echo $row['resumo']?>
								
								<?php if ($row['comentarios']): ?>
								<br>
								<small style="text-align: right; display: block;"><?php echo $row['comentarios']?> comentários</small>
								<?php endif ?>
								</p>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
			<div id="divMais">
				<a class="dir" href="noticias">Mais notícias (+)</a>
			</div>
		</div>
		<!-- CONTEUDO > Artigos -->
		<div class="quadroEsq">
			<div id="divTitulo">
				<h1>Artigos</h1>
				<a id="rss" href="<?php echo base_url()?>artigos/rss"><img src="<?php echo base_url()?>site/img/rss.gif" /> RSS</a>
				<select onchange="alternaArtigos();">
					<option selected="selected" >Últimas</option>
					<option>Mais Acessadas</option>  
				</select>
				<p>filtrar</p>
			</div>
			<ul id="artUltimas">
				<!-- Artigo Destaque -->
				<?php if ($artigoDestaque){ ?>
					<li id="destaque">
					<?php
					foreach ($artigoDestaque as $row){
						?>
						<a href="<?php echo base_url()?>artigos/ver/<?php echo $row['id']?>">
							<h3><?php echo $row['titulo']?></h3>
							<p>
							<?php echo $row['resumo']?>
							
							<?php if ($row['comentarios']): ?>
							<br>
							<small style="text-align: right; display: block;"><?php echo $row['comentarios']?> comentários</small>
							<?php endif ?>
							</p>
						</a>
						<?php
					}
					?>
					</li>
				<?php } ?>
				<!-- Os três últimos artigos cadastrados -->
				<?php 
				if ($artigosPrincipais){
					foreach ($artigosPrincipais as $row){
						$dataArtigosPrincipais = sqlToDateDiaMes($row['data']);
						?>
						<li>
							<a href="<?php echo base_url()?>artigos/ver/<?php echo $row['id']?>">
								<h3><span><?php echo sqlToDateDiaMes($row['data'])?></span> <?php echo $row['titulo']?></h3>
								<p>
								<?php echo $row['resumo']?>
								
								<?php if ($row['comentarios']): ?>
								<br>
								<small style="text-align: right; display: block;"><?php echo $row['comentarios']?> comentários</small>
								<?php endif ?>
								</p>
							</a>
						</li>
						<?php
					}
				}
				?>
				<!--  -->
			</ul>
			<ul id="artMaisAcessados" style="display: none;">
				<?php 
				if ($artigoAcessos){
					foreach ($artigoAcessos as $row){
						$dataArtigoAcessos = sqlToDateDiaMes($row['data']);
						?>
						<li>
							<a href="<?php echo base_url()?>artigos/ver/<?php echo $row['id']?>">
								<h3><span><?php echo sqlToDateDiaMes($row['data'])?></span> <?php echo $row['titulo']?></h3>
								<p>
								<?php echo $row['resumo']?>
								
								<?php if ($row['comentarios']): ?>
								<br>
								<small style="text-align: right; display: block;"><?php echo $row['comentarios']?> comentários</small>
								<?php endif ?>
								</p>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
			<div id="divMais">
				<a class="dir" href="artigos">Mais artigos (+)</a>
				<!--  <a href="#">Publique seu artigo</a>-->
			</div>
		</div>
	</div>
	<div id="divColunaDir">
		<!-- CONTEUDO > Juízo diário -->
		<div class="quadroDir">
			<div id="divTitulo">
				<h1>Juízo Diário</h1>
			</div>
			<ul>
			<?php 
				if ($juizoDiario){
					foreach ($juizoDiario as $row){
						echo "
							<li>
								<a href=\"juizodiario/ver/$row[id]\">
									<h3>$row[pergunta]</h3>
								</a>
							</li>
						";
					}?>
			</ul>
			<div id="divMais">
				<a class="dir" href="juizodiario/ver/<?php echo $row['id']?>">Ver resposta (+)</a>
			</div>
			<?php }	?>
		</div>
		<!-- CONTEUDO > Direito empresarial -->
		<div class="quadroDir">
			<div id="divTitulo">
				<h1>Temas de Direito Empresarial</h1>
			</div>
			<ul>
			<?php 
				if ($direitoDestaque){
					foreach ($direitoDestaque as $row){
						echo "
							<li>
								<a href=\"artigos/ver/$row[id]\">
									<h3>$row[titulo]</h3>
									<p>$row[resumo]</p>
								</a>
							</li>
						";
					}?>
				</ul>
				<div id="divMais">
					<a class="dir" href="artigos/ver/<?php echo $row[id]?>">Texto completo</a>
				</div>
				<?php }	?>
		</div>
		<!-- CONTEUDO > Multimídia -->
		<div class="quadroDir">
			<div id="divTitulo">
				<h1>Novo Classe</h1>
			</div>
			<ul>
				<li>
					<a href="http://www.classecontabil.com.br/v3/video/ver/20">
						<img src="<?php echo base_url()?>site/img/img/novoclasse.jpg" alt="Podcast" border="0" class="esq" style="margin-right: 10px" width="67px" />
						<h3>Conheça o novo Portal da Classe Contábil e saiba como utilizar as ferramentas disponíveis.</h3>
					</a>
					<div style="clear: both"></div>
				</li>
			</ul>
		</div>
		<!-- CONTEUDO > Dicas do Portal -->
		<div class="quadroDir">
			<div id="divTitulo">
				<h1>Dicas do Portal</h1>
			</div>
			<ul>
			<?php 
				if ($dicasPortal){
					foreach ($dicasPortal as $row){?>
						<li>
							<h3><?php echo $row['titulo']?></h3>
							<p><?php echo inserirTags($row['dica'])?></p>
						</li>
				<?php }
				}?>
			</ul>	
		</div>
		<!-- CONTEUDO > Depoimentos -->
		<div class="quadroDir">
			<div id="divTitulo">
				<h1>Depoimentos</h1>
			</div>
			<ul>
				<script>
					function mostrar() {
						obj1 = document.getElementById("indicacao");
						if (obj1.style.display=='block') {
							obj1.style.display='none';
						} else {
							obj1.style.display='block';
						}
					}
				</script>
				<li id="destaque">
				<?php foreach ($depoimentosPortal as $rowDepoimentos){?>
					<p>"<?php $rowDepoimentos['depoimento']?>"</p>
					<p style="text-align: right; font-size: 10px;"><i><?php echo str_replace("<br>", ". ", $rowDepoimentos['nome'])?> - <?php echo $rowDepoimentos['email']?></i></p>
				<?php }?>
				</li>
				<li style="padding: 0;"></li>
				<div id="divMais" style="text-align: right">
				<?php foreach ($depoimentosPortalMax as $rowMax){?>
					<p><a href="<?php echo base_url()?>depoimentos">Mais Depoimentos (<?php echo $rowMax['qtd']?>)</a></p>
				<?php }?>
					<p><a href="#deixeDepoimento" onclick="mostrar();">Deixe seu Depoimento </a></p>
				</div>
				<?php if($session_idUsuario){?>
				<!-- Exibir o Formulário para deixar um depoimento -->
				<form action="<?php echo base_url()?>inicio/enviarDepoimento" method="post" id="formIndicacao">
					<?php if($session_idUsuario){?>
					<input type="hidden" name="nome" value="<?php echo $session_login?>">
					<input type="hidden" name="email" value="<?php echo $session_email?>">
					<input type="hidden" name="id" value="<?php echo $session_idUsuario?>">
					<?php } ?>
					<a name="deixeDepoimento"></a>
					<div id="indicacao" style="display: <?php echo($showDepoimento) ? "block" : "none"?>; margin-top: 20px;">
						<?php echo $depoimentoForm; ?>
					</div>
				</form>
				<?php } else {?>
					<div id="indicacao" style="display: none; margin-top: 20px;">
						<form action="<?php echo base_url()?>login/validar" method="post">	
							<input type="hidden" name="backTo" value="/inicio/index/1/#deixeDepoimento"/>
							<fieldset>
								<span>Para deixar um depoimento, informe seus dados.</span><br /><br />
								<label style="width: 50px">E-mail</label><input type="text" name="email" value="<?php echo $email?>"><br />
								<label style="width: 50px">Senha</label><input type="password" name="senha"><br />
								<label style="width: 50px">&nbsp;</label><input type="submit" value="Acessar" class=""><br />
								<label style="width: 50px">&nbsp;</label><a href="<?php echo base_url()?>login/esqueciMinhaSenha" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Esqueci minha senha</a>
								<a href="<?php echo  base_url()?>login/cadastrar/" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Ainda não sou cadastrado</a>
							</fieldset><br />
						</form>
					</div>
				<?php }?>
			</ul>	
		</div>
		<!-- CONTEUDO > Videos -->
		<!--
		<div id="divVideos">
			<div id="divTitulo">
				<h1>Vídeos</h1>
				<a id="rss" href="#"><img src="<?php echo  base_url()?>site/img/rss.gif" /> RSS</a>
				<select onchange="alternaVideos();">
					<option selected="selected">Últimas</option>
					<option>Mais acessados</option> 
				</select>
				<p>filtrar</p>
			</div>
			
			<div id="divTela" >
				<?php if ($videoDestaque) {	?>	
					<img border="0" src="<?php echo base_url()?>site/videos/<?php echo $videoDestaque['icoDestaque']?>"  width="110px" height="80px"/>
					<p><a id="legenda" href="<?php echo base_url()?>video/ver/<?php echo $videoDestaque['id']?>"><?php echo $videoDestaque['titulo']?></a></p>
				<?php }?>
			</div>
			<ul id="videoUltimas">
				<?php 
					if ($video) {
						$classe = array('um','dois','tres','quatro');
						$i = 0;
						foreach ($video as $rowVideo) {
				?>
					<li><a class="<?php echo $classe[$i]?>" href="<?php echo base_url()?>video/ver/<?php echo $rowVideo['id']?>"><?php echo $rowVideo['titulo']?></a></li>
				<?php 	
						$i++;		
						}
					}
				?>
			</ul>
			<ul id="videoMaisAcessados" style="display: none;">
				<?php 
					if ($videoAcessados) {
						$classe = array('um','dois','tres','quatro');
						$i = 0;
						foreach ($videoAcessados as $rowVideoAcessados) {
				?>
					<li><a class="<?php echo $classe[$i]?>" href="<?php echo base_url()?>video/ver/<?php echo $rowVideoAcessados['id']?>"><?php echo $rowVideoAcessados['titulo']?></a></li>
				<?php 	
						$i++;		
						}
					}
				?>
			</ul>
			<div id="divMais">
				<a class="esq" href="#">Sugira novos temas e vídeos</a>
				<a class="dir" href="<?php echo  base_url() ?>video">Mais vídeos (+)</a>
			</div>
		</div>
		-->
		<!-- CONTEUDO > Podclasse -->
		<!--
		<div id="divPodclasse">
			<div id="divTitulo">
				<h1>PodClasse</h1>
				<a id="rss" href="#"><img src="<?php echo  base_url()?>site/img/rss.gif" /> RSS</a>
			</div>
			<p><a href="#">Como ouvir</a> | <a href="#">RSS Feed?</a></p>
			<ul>
				<?php
				if ($podClasse) {
					foreach ($podClasse as $rowPodClasse) {
						?>
						<li>
							<p><b><?php echo $rowPodClasse['titulo']?></b> - <?php echo $rowPodClasse['descricao']?></p>
							<embed
							src="<?php echo  base_url()?>site/podclasse/podcast.swf"
							width="230"
							height="24"
							flashvars="playerID=1&amp;bg=0xD0EBEA&amp;leftbg=0x01B8C0&amp;lefticon=0xFFFFFF&amp;rightbg=0x00CCC8&amp;righticon=0xFFFFFF&amp;soundFile=<?php echo base_url()?>site/podclasse/<?php echo $rowPodClasse['arquivo']?>"
							/>
							</embed>
							<a href="#"><img id="comentar" src="<?php echo  base_url()?>site/img/podcastComentar.gif" alt="Comentar" /></a>
							<a href="#nogo" onclick="alternarIndicacao(<?php echo $rowPodClasse['id']?>)"><img src="<?php echo  base_url()?>site/img/podcastIndicar.gif" alt="Indicar" /></a>
						</li>
						<?php
					}
				}
				?>
			</ul>
			<form method="post" id="formIndicacao">
				<div id="indicacao" style="display: none;">
					<?php echo $podClasseIndicacao; ?>
				</div>
			</form>
			<div id="divMais">
				<a class="dir" href="<?php echo  base_url()?>pod">Mais podcastings (+)</a>
			</div>
		</div>
		-->
	</div>
</div>}
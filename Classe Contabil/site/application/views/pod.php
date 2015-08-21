<?php  
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
<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Contábil" href="<?php echo base_url()?>pod/rss" />
<!-- CONTEÚDO -->
<div id="divConteudo">
	<h1 class="titulo">Todos os Podcastings</h1>
	<div class="divisa"></div>
	<ul class="listagem">
	<?php
	foreach ($pod as $row){
	?>
		<li>
				<p class="data">
				<?php echo  $row['acesso']?> acessos
				<?php if ($row['comentarios']){?>
					<br /><?=$row['comentarios']?> comentários
				<?php }?>
				</p>
				<h1><a href="<?php echo base_url() ?>pod/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></h1><br>
				<p><a href="<?php echo base_url() ?>pod/ver/<?php echo $row['id']?>"><?php echo  substr($row['descricao'], 0, 100); ?>(...)</a></p>
		</li>
	<?php }	?>
	</ul>
	<?php echo "<br /><br />$pag
	 <p align=center>$qtd de $total</p>";
?>
</div>

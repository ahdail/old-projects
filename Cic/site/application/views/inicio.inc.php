<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
<link rel="shortcut icon" href="<?php echo base_url() ?>site/img/favicoCIC.ico">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="Author" content="Web Design - Henrique Gogó">
<meta name="Author" content="Web Development - Ahdail Netto, Eric Sabóia, Tibiriça Botto">
<meta name="reply-to" content="Ahdail Netto">
<meta name="Robots" content="All">
<meta name="description" content="CIC - Centro Industrial do Ceará, Fortes Informática" />
<meta name="keywords" content="cic, fiec, centro industrial do ceará, industrias, ceará, ciclo de debates, obec" />

<title>CIC - Centro Industrial do Ceará</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>site/css/cic.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.form.js"></script>
<script language="javascript">
function alturaConteudo() {
	if (window.innerHeight) {
		var altura = (window.innerHeight - 255)+"px";
	} 
	else {
		var altura = (document.body.clientHeight - 255)+"px";
	}
	if (navigator.userAgent.toLowerCase().indexOf('msie 6') != -1) {
		document.getElementById('conteudo').style.height=altura;
		document.getElementById('tiraEsq').style.height=altura;
		document.getElementById('tiraDir').style.height=altura;
	}
}
</script>
</head>

<body>
<div id="gog">

<!-- TOPO -->
<div id="topo">
	<a href="<?php echo base_url() ?>inicio"><img onload="alturaConteudo()" class="esq" src="<?php //echo base_url() ?>site/img/topoLogoCIC.gif" alt="CIC" /></a>
	<!-- <a href="http://www.sfiec.org.br/" target="_blank"><img class="dir" src="<?php echo base_url() ?>site/img/topoLogoFIEC.gif" alt="FIEC" /></a>-->
</div>
<div id="topoBase"></div>

<!-- MENU -->
<div id="menu">
	<ul>
		<li><a href="<?php echo base_url() ?>quemsomos">Quem somos</a></li>
		<li><a href="<?php echo base_url() ?>presidente">Opinião</a></li>
		<li><a href="<?php echo base_url() ?>noticia">Notícia</a></li>
		<li><a href="<?php echo base_url() ?>agenda">Agenda</a></li>
		<li><a href="<?php echo base_url() ?>imprensa">CIC na Imprensa</a></li>
		<li><a href="<?php echo base_url() ?>ciclodebate">Ciclo de Debates</a></li>
		<!--  <li><a href="#">Indicadores</a></li>-->
		
		<?php foreach ($menu as $row){?>
		<li><a href="<?php echo base_url() ?>novapagina/ver/<?php echo $row['id']?>"><?php echo $row['menu']?></a></li>		
		<?php }?>
	</ul>
	<form action="<?php echo base_url()?>busca" method="post">
		<!--<h2>Busca</h2>
		<div id="input" class="esq"><span><input type="text" name="busca" style="width: 90px"/>
		</span></div>  
		<input class="esq" type="image" src="<?php echo base_url() ?>site/img/enviar.gif" />-->
	</form><br />
	<br />
	<?php 
	// BANNERS LATERAIS
	if ($bannerLateralUm){
		if ($bannerLateralUm['tipo'] == "2") { // Se for imagem
			$caminhoImg = base_url()."site/banners/".$bannerLateralUm['arquivo'];
			if ($bannerLateralUm['novaJanela'] == "S"){
				$target = "target = _blank";
			}
			?>			
			<a href="<?php echo $bannerLateralUm['url']?>" <?php echo $target ?>><img class="meio" src="<?php echo $caminhoImg?>" width=<?php echo $bannerLateralUm['largura']?> height=<?php echo $bannerLateralUm['altura']?> border="0" /></a> 
			<br/>
			<?php	
		} else { // Se for flash
			?>			
			<embed src="<?php echo $caminho ?>"	width="<?php echo $bannerLateralUm['largura'] ?>" height="<?php echo $bannerLateralUm['altura'] ?>" allowscriptaccess="always" allowfullscreen="true" ></embed>
			<br />	
			<?php
		}
	}	
	
	if ($bannerLateralDois){
		if ($bannerLateralDois['tipo'] == "2") {		 // Se for imagem
			$caminhoImg = base_url()."site/banners/".$bannerLateralDois['arquivo'];
		if ($bannerLateralUm['novaJanela'] == "S"){
				$target = "target = _blank";
			}
			?>			
			<a href="<?php echo $bannerLateralDois['url']?>" <?php echo $target ?>><img class="meio" src="<?php echo $caminhoImg?>" width=<?php echo $bannerLateralDois['largura']?> height=<?php echo $bannerLateralDois['altura']?> border="0" /></a> 
			<br/>
			<?php	
		} else { // Se for flash
			?>			
			<embed src="<?php echo $caminho ?>"	width="<?php echo$bannerLateralDois['largura'] ?>" height="<?php echo $bannerLateralDois['altura'] ?>" allowscriptaccess="always" allowfullscreen="true" ></embed>
			<br />	
			<?php
		}
	}	
	
	if ($bannerLateralTres){
		if ($bannerLateralTres['tipo'] == "2") { // Se for imagem		
			$caminhoImg = base_url()."site/banners/".$bannerLateralTres['arquivo'];
		if ($bannerLateralUm['novaJanela'] == "S"){
				$target = "target = _blank";
			}
			?>			
			<a href="<?php echo $bannerLateralTres['url']?>" <?php echo $target ?>><img class="meio" src="<?php echo $caminhoImg?>" width=<?php echo $bannerLateralTres['largura']?> height=<?php echo $bannerLateralTres['altura']?> border="0" /></a> 
			<?php	
		} else { // Se for flash
			?>			
			<embed src="<?php echo $caminho ?>"	width="<?php echo $bannerLateralTres['largura'] ?>" height="<?php echo $bannerLateralTres['altura'] ?>" allowscriptaccess="always" allowfullscreen="true" ></embed>
			<?php
		}
	}	
	?>
</div>
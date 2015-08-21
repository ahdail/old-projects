<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Prefeitura Municipal de Chorozinho - 25 anos</title>
<link rel="stylesheet" href="css/reset.css" />

<link rel="stylesheet" href="css/styles.css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/reset.css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/960.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.lightbox-0.5.css" />


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript" src="http://malsup.github.com/chili-1.7.pack.js"></script>

<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>

<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>

<script type="text/javascript" src="http://malsup.github.com/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.lightbox-0.5.js"></script>

<script type="text/javascript">

$(function() {

    $('#slideshow').before('<div id="nav" class="nav">').cycle({

        fx:     'fade',

        speed:  'fast',

        timeout: 3000,

        pager:  '#nav',

        before: function() { if (window.console) console.log(this.src); }

    });

});

</script>

<script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29841735-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</head>

<body>

<div class="container_12 body">

<div id="header">
	<div class="wrapper">

    <div class="mainmenu">
        <ul class="menu">
            <li class="list">
                <a class="category" href="<?php echo base_url();?>home">Início</a>                
            </li>
        </ul>
        <ul class="menu">
            <li class="list">
                <a class="category" href="#articles">Secretarias</a>
                
                
                
                <ul class="submenu">
                
              
                
                	<?php foreach ($secretarias as $row) {?>

			<li style="font-size:11px;">
				<a href="<?php echo base_url();?>secretaria/ver/<?php echo $row['id_secretaria']?>#cont" ><?php echo $row['nome_secretaria'];?></a>
			</li>
			
			<?php } ?>
                    
                    
                </ul>
            </li>
        </ul>
		<ul class="menu">
            <li class="list">
                <a class="category" href="<?php echo base_url();?>noticia#cont">Notícias</a>                
            </li>
        </ul>
		<ul class="menu">
            <li class="list">
                <a class="category" href="<?php echo base_url();?>igrejaegruta#cont">Igreja e Gruta</a>                
            </li>
        </ul>
		<ul class="menu">
            <li class="list">
                <a class="category" href="<?php echo base_url();?>gestao#cont">Gestão 2009-2012</a>                
            </li>
        </ul>
        
		<ul class="menu">
            <li class="list">
                <a class="category" href="#">&nbsp;</a>                
            </li>
        </ul>
        
        <ul class="menu last">
            <li class="list">
                <a class="category" href="http://www.chorozinho.ce.gov.br:2095/" target="_blank">WebMail</a>                
            </li>
        </ul>
    </div>
</div>
    <a href="<?php echo base_url();?>home"><img src="<?php echo base_url();?>img/header2.jpg" /></a>
</div>

<div id="sidebar1" class="grid_3 alpha">
	<ul>
    <p>Município</p>
    	<li><a href="<?php echo base_url();?>municipio#cont">Conheça</a></li>
        <li><a href="<?php echo base_url();?>historia#cont">Nossa História</a></li>        
        <!--<li><a href="#">Aspectos Geográficos</a></li>-->
        <!--<li><a href="#">Atividade Econômica</a></li>-->
        <li><a href="<?php echo base_url();?>comochegar#cont">Como Chegar?</a></li>
        <!--<li><a href="#">Dados Populacionais</a></li>-->
		<li><a href="<?php echo base_url();?>noticia#cont">Notícias</a></li>
		<li><a href="<?php echo base_url();?>videos#cont">Nossos Vídeos</a></li>
		<li><a href="<?php echo base_url();?>galeria#cont">Galeria de Fotos</a></li>
    </ul>
    
    <ul>
    <p>Governo</p>
    	<li><a href="<?php echo base_url();?>gestao#cont">Gestão 2009-2012</a></li>
        <li><a href="<?php echo base_url();?>contato/ouvidoria#cont">Ouvidoria</a></li>
    </ul>
    
    <ul>
    <p>Turismo</p>
    	<li><a href="<?php echo base_url();?>igrejaegruta#cont">Igreja e Gruta</a></li>
        <li><a href="<?php echo base_url();?>festividades#cont">Festividades</a></li>
    </ul>
    <!--
    <ul>
    <p>Leis Municipais</p>
    	<li><a href="legislacao.php#cont">Legislação</a></li>
    </ul>
    
    <ul>
    <p>Portal do Servidor</p>
    	<li><a href="#">Contra-Cheque</a></li>
        <li><a href="#">Imposto de Renda</a></li>
    </ul>
    -->
    <ul>
    <p>Contatos</p>
    	<li><a href="<?php echo base_url();?>contato/faleconosco#cont">Fale Conosco</a></li>
        <li><a href="<?php echo base_url();?>contato/telefonesuteis#cont">Telefones Úteis</a></li>
    </ul>
   
</div>
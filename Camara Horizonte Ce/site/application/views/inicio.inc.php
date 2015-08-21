<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Ahdail Netto
http://www.ahdail.net
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Câmara Municipal de Horizonte - Ceará</title>
<meta name="keywords" content="" />
<meta name="Câmara Municipal Horizonte" content="" />
<link href="<?php echo base_url()?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
<!--

#slidebox{position:relative; border:2px solid #FDC00F; margin:20px auto;}
#slidebox, #slidebox .content{width:512px;}
#slidebox, #slidebox .container, #slidebox .content{height:250px;}
#slidebox{overflow:hidden;}
#slidebox .container{position:relative; left:0;}
#slidebox .content{background:#eee; float:left;}
#slidebox .content div{padding:15px 28px; height:100%; font-family:Verdana, Geneva, sans-serif; font-size:13px;}
#slidebox .next, #slidebox .previous{position:absolute; z-index:2; display:block; width:21px; height:21px;}
#slidebox .next{right:0; margin-right:2px; background:url(slidebox_next.png) no-repeat left top;}
#slidebox .next:hover{background:url(slidebox_next_hover.png) no-repeat left top;}
#slidebox .previous{margin-left:2px; background:url(slidebox_previous.png) no-repeat left top;}
#slidebox .previous:hover{background:url(slidebox_previous_hover.png) no-repeat left top;}
#slidebox .thumbs{position:absolute; z-index:2; bottom:10px; right:10px;background: #F13E37}
#slidebox .thumbs .thumb{display:block; margin-left:5px; float:left; font-family:Verdana, Geneva, sans-serif; font-size:9px; text-decoration:none; padding:2px 4px; background:url(slidebox_thumb.png); color:#EFEFEF;}
#slidebox .thumbs a.thumb:hover{background:#fff; color:#000;}
#slidebox .thumbs a.thumb:link{background: #F13E37; text-decoration: none;}
-->
</style>

<script language="JavaScript" src="<?php echo base_url();?>site/js/jquery-lightbox/js/jquery.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo base_url();?>site/js/jquery-lightbox/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>site/js/jquery-lightbox/css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<? echo base_url()?>js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<? echo base_url()?>js/slidebox/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var autoPlayTime=7000;
	autoPlayTimer = setInterval( autoPlay, autoPlayTime);
	function autoPlay(){
		Slidebox('next');
	}
	$('#slidebox .next').click(function () {
		Slidebox('next','stop');
	});
	$('#slidebox .previous').click(function () {
		Slidebox('previous','stop');
	});
	var yPosition=$('#slidebox').height()/2-$('#slidebox .next').height()/2;
	$('#slidebox .next').css('top',yPosition);
	$('#slidebox .previous').css('top',yPosition);
});
//slide page to id
function Slidebox(slideTo,autoPlay){
    var animSpeed=1000; //animation speed
    var easeType='easeInOutExpo'; //easing type
	var sliderWidth=$('#slidebox').width();
	var leftPosition=$('#slidebox .container').css("left").replace("px", "");
	$("#slidebox .content").each(function (i) {
		totalContent=i*sliderWidth;	
		$('#slidebox .container').css("width",totalContent+sliderWidth);
	});
	if( !$("#slidebox .container").is(":animated")){
		if(slideTo=='next'){ //next
			if(autoPlay=='stop'){
				clearInterval(autoPlayTimer);
			}
			if(leftPosition==-totalContent){
				$('#slidebox .container').animate({left: 0}, animSpeed, easeType); //reset
			} else {
				$('#slidebox .container').animate({left: '-='+sliderWidth}, animSpeed, easeType); //next
			}
		} else if(slideTo=='previous'){ //previous
			if(autoPlay=='stop'){
				clearInterval(autoPlayTimer);
			}
			if(leftPosition=='0'){
				$('#slidebox .container').animate({left: '-'+totalContent}, animSpeed, easeType); //reset
			} else {
				$('#slidebox .container').animate({left: '+='+sliderWidth}, animSpeed, easeType); //previous
			}
		} else {
			var slide2=(slideTo-1)*sliderWidth;
			if(leftPosition!=-slide2){
				clearInterval(autoPlayTimer);
				$('#slidebox .container').animate({left: -slide2}, animSpeed, easeType); //go to number
			}
		}
	}
}
</script>
<!-- Ativando o jQuery lightBox plugin -->
<script type="text/javascript">
	$(function() {
		$('#fotos_ a').lightBox();
	});
</script>
<style type="text/css">
	#box_esquerda {
		float:right;
		padding-right:10px;
	}
	#box_direita {
		float:left;
	}
</style>
</head>
<body>
<!-- start header -->
<div id="header">
	<a href="<?php echo base_url();?>"><div id="logo"></div></a>
	<div id="menu">
		<ul id="main">
			<li class="current_page_item"><a href="<?php echo base_url();?>">Home</a></li>
			<li><a href="<?php echo base_url();?>camara">A Câmara</a></li>			
			<li><a href="<?php echo base_url();?>vereadores">Vereadores</a></li>
			<li><a href="<?php echo base_url();?>noticia">Notícias</a></li>		
			<li><a href="<?php echo base_url();?>album">Fotos</a></li>
			<li><a href="<?php echo base_url();?>falecomvereador">Fale com seu vereador</a></li>			
			<li><a href="<?php echo base_url();?>vozcidadao">Assessoria</a></li>			
			
		</ul>
	</div>
	
</div>


<!-- end header -->
<div id="wrapper">


	<!-- start page -->
	<div id="page">
		
		
		<div id="sidebar1" class="sidebar">
		
		
			<ul>
				<li>
					<h2>Início</h2>
					<ul>
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li><a href="<?php echo base_url();?>camara">A Câmara</a></li>
						<li><a href="<?php echo base_url();?>vereadores">Vereadores</a></li>
						<li><a href="<?php echo base_url();?>vereadores/presidente">Presidente</a></li>
						<li><a href="<?php echo base_url();?>vereadores/mesadiretora">Mesa Diretora</a></li>						
						
						
					</ul>
				</li>
			</ul>
			<ul>
				<li>
					<h2>Comissões</h2>
					<ul>
					<?php foreach ($comissoes as $row){ ?>
						<li><a href="<?php echo base_url();?>comissao/ver/<?php echo $row['id']?>"><?php echo $row['nome']?></a></li>						
					<?php } ?>	
					</ul>
				</li>
			</ul>	
			<ul>
				<li>
					<h2>Legislação</h2>
					<ul>
					<?php foreach ($legislacoes as $row){ ?>
						<li><a href="<?php echo base_url();?>leg/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></li>						
					<?php } ?>						
					
					</ul>
				</li>
			</ul>	
			<!--
			<ul>
				<li>
					<h2>Leis Municipais</h2>
					<ul>
					<?php foreach ($leismunicipais as $row){ ?>
						<li><a href="<?php echo base_url();?>lei/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></li>						
					<?php } ?>						
					
					</ul>
				</li>
			</ul>
			-->
			<!--
			<ul>
				<li>
					<h2>Apoio</h2>
					<ul>
						<li>
							<?php foreach ($apoio as $row){?>
								<a href="<?php echo base_url();?>apoio_servico/ver/<?php echo $row['id'];?>"><img src="<?php echo base_url();?>site/parceiros/<?php echo $row['imagem'];?>" width="185"></a><br /><br />																								
							<?php } ?>
						</li>
						
					</ul>
				</li>
			</ul>
			-->
		</div>

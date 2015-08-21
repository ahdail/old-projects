<?php print '<?xml version="1.0" encoding="utf-8"?>';?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BABAYAGA - Vestindo Desejos</title>
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColHybRtHdr #sidebar1 { padding-top: 30px; }
.twoColHybRtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it may need to avoid several bugs */
</style>
<![endif]-->
<link href="<?php echo base_url();?>site/css/estilo_.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php echo base_url();?>site/js/jquery-lightbox/js/jquery.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo base_url();?>site/js/jquery-lightbox/js/jquery.lightbox-0.5.js" type="text/javascript"></script>
<script language="JavaScript" src="<?php echo base_url();?>site/js/slidebox/jquery.easing.1.3.js" type="text/javascript"></script>

<script language="JavaScript" src="<?php echo base_url();?>site/js/jquery.validate.js" type="text/javascript"></script>

<link href="<?php echo base_url();?>site/js/jquery-lightbox/css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />

<!-- Ativando o jQuery lightBox plugin -->
<script type="text/javascript">
	$(function() {
		$('#fotos_ a').lightBox();
	});
</script>

<style type="text/css">
<!--

#slidebox{position:top; border:5px solid #FFFFFF; margin:40px auto;}
#slidebox, #slidebox .content{width:750px;}
#slidebox, #slidebox .container, #slidebox .content{height:270px;}
#slidebox{overflow:hidden;}
#slidebox .container{position:relative; left:0;}
#slidebox .content{background:#eee; float:left;}
#slidebox .content div{height:100%; font-family:Verdana, Geneva, sans-serif; font-size:13px;}
#slidebox .next, #slidebox .previous{position:absolute; z-index:2; display:block; width:21px; height:21px;}
#slidebox .next{right:0; margin-right:2px; background:url(slidebox_next.png) no-repeat left top;}
#slidebox .next:hover{background:url(slidebox_next_hover.png) no-repeat left top;}
#slidebox .previous{margin-left:2px; background:url(slidebox_previous.png) no-repeat left top;}
#slidebox .previous:hover{background:url(slidebox_previous_hover.png) no-repeat left top;}
#slidebox .thumbs{position:absolute; z-index:2; bottom:10px; right:10px;}
#slidebox .thumbs .thumb{display:block; margin-left:5px; float:left; font-family:Verdana, Geneva, sans-serif; font-size:9px; text-decoration:none; padding:2px 4px; background:url(slidebox_thumb.png); color:#fff;}
#slidebox .thumbs a.thumb:hover{background:#fff; color:#000;}
-->
</style>

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

<script type="text/javascript">
            $(document).ready( function() {
                $("#formularioContato").validate({
                    // Define as regras
                    rules:{
                        campoNome:{
                            // campoNome será obrigatorio (required) e terá tamanho minimo (minLength)
                            required: true, minlength: 2
                        },
                        campoEmail:{
                            // campoEmail será obrigatorio (required) e precisará ser um e-mail válido (email)
                            required: true, email: true
                        },
                        campoMensagem:{
                            // campoMensagem será obrigatorio (required) e terá tamanho minimo (minLength)
                            required: true, minlength: 2
                        }
                    },
                    // Define as mensagens de erro para cada regra
                    messages:{
                        campoNome:{
                            required: "<font size='1' color='#ffffff'><br/>Digite o seu nome</font>",
                            minlength: "<font size='1' color='#ffffff'><br/>O seu nome deve conter, no mínimo, 2 caracteres</font>"
                        },
                        campoEmail:{
                            required: "<font size='1' color='#ffffff'><br/>Digite o seu e-mail para contato</font>",
                            email: "<font size='1' color='#ffffff'><br/>Digite um e-mail válido</font>"
                        }
                    }
                });
            });
        </script>



	
</head>

<body class="direito">

<div id="container">
  <div id="header">
    <!-- end #header -->
    <div class="marcababayaga"><a href="<?php echo base_url();?>inicio/site"><img src="<?php echo base_url();?>site/images/marca_babayaga.jpg" width="279" height="76" border="0" /></a></div>
    <div class="menu_babayaga">
     <table width="100%" border="0">
         <tr>
           <td width="27%">
				<a href="<?php echo base_url();?>empresa">A empresa</a><br />
				<a href="<?php echo base_url();?>perfil">Perfil</a><br />
				<a href="<?php echo base_url();?>colecao">Coleções</a><br />
				<a href="<?php echo base_url();?>dica">Dicas</a><br />
				<a href="<?php echo base_url();?>evento">Eventos</a><br />
				<a href="<?php echo base_url();?>noticia">Notícias</a><br />
				<a href="<?php echo base_url();?>video">Galeria de Vídeo</a><br />
				<a href="<?php echo base_url();?>galeriafotos">Galeria de Fotos</a><br />
				<a href="<?php echo base_url();?>faleconosco">Fale Conosco</a>
			</td>
			<td width="43%" valign="baseline"><img src="<?php echo base_url();?>site/images/newsletter.jpg" width="182" height="61" />
			<form id="formularioContato" name="formularioContato" method="post" action="<?php echo base_url();?>newsletter">
				<input name="campoNome" type="text" class="formulario_news" id="campoNome" value="digite aqui seu nome" /><br />
				<input name="campoEmail" type="text" class="formulario_news" id="campoEmail" value="digite aqui seu email" /><br>
				<input name="formSite" type="hidden" class="formulario_news" id="formSite" value="true" />	
				<input type="submit" value="cadastrar" style="font-size:10px;color:#5E0E11; border-color:#5E0E11;background:#C8B58A;font-weight:bold;font-family: Georgia, Times New Roman, Times, serif;width:70px;height:20px;">
            </form></td>
           <td width="30%" valign="bottom"><img src="<?php echo base_url();?>site/images/atendimento-on-line.jpg" width="130" height="37" /></td>
         </tr>
       </table>
      <br />
    </div>
  </div>
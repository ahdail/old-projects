<?php 
	$session_idUsuario = $this->session->userdata('id');
	$session_login = $this->session->userdata('login');
	//$loginArray = explode(" ", $session_login);
	//$loginSessao = $loginArray[0];
	checkLogin($session_login);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Babayaha - Vestindo desejos</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/theme.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/ThickBox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/js/colorbox/colorbox.css" />
	<link type="text/css" href="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" />	
	<link type="text/css" href="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/demo/demos.css" rel="stylesheet" />
	
	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/js/jquery-1.4.2.js"></script>	
	
	<script type="text/javascript" src="<?php echo base_url()?>site/js/thickbox.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>site/js/colorbox/jquery.colorbox.js"></script>
	
	
	
	
	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/external/jquery.bgiframe-2.1.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/ui/jquery.ui.datepicker.js"></script>
	
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
	<script type="text/javascript">
	// Cria as instancias prï¿½ configuradas para o editor
		var oEdit1 = new preparaEditor('oEdit1');

		var oEdit2 = new preparaEditor('oEdit2');
	</script>
	<script type="text/javascript">
	$(function() {
		$("#periodo1").datepicker();
		$("#periodo2").datepicker();
	});
	</script>
	
	
	
	<script language="javascript">
	function Abrir(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/caixa/abrir/"+id;
		} else{
			window.location.href="<?php echo base_url()?>pdv/usuariocategoria/deletar/"+id;
		}
	}

	</script>

	<script>
	   var StyleFile = "theme3.css";
	   document.writeln('<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/theme3.css">');
	</script>
	<script language="javascript">

		if (document.getElementById){ //DynamicDrive.com change
			document.write('<style type="text/css">\n')
			document.write('.submenu{display: none;}\n')
			document.write('</style>\n')
		}

		function SwitchMenu(obj){
			if(document.getElementById){
			var el = document.getElementById(obj);
			var ar = document.getElementById("sidebar").getElementsByTagName("ul"); //DynamicDrive.com change
				if(el.style.display != "block"){ //DynamicDrive.com change
					for (var i=0; i<ar.length; i++){
						if (ar[i].className=="submenu") //DynamicDrive.com change
						ar[i].style.display = "none";
					}
					el.style.display = "block";
				}else{
					el.style.display = "none";
				}
			}
		}

</script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->


</head>

<body >

	<div id="container">
    
        	<img src="<?php echo base_url()?>site/img/babayaga.jpg" ><br /><br />
		
        <div id="top-panel">
           <h3>Bem-vindo, <?php echo $session_login;?>- <a href="<?php echo base_url();?>admin/logout" class="">Sair [x]</a></h3>
		</div>

		<div id="wrapper">
			<div id="sidebar">
  				<ul>
                	<li><h3 onclick="SwitchMenu('subQuemSomos')"><a href="#" class="">A empresa</a></h3>
                        <ul class="submenu" id="subQuemSomos">
                        	<li><a href="<?php echo base_url();?>admin/quemsomos/listar" class="">Quem somos</a></li>                    		
                        </ul>
                    </li>
                    <li><h3 onclick="SwitchMenu('subColecao')"><a href="#" class="">Coleção</a></h3>
                        <ul class="submenu" id="subColecao">
                        	<li><a href="<?php echo base_url();?>admin/colecao/manter" class="">Nova coleção</a></li> 
							
							<li><a href="<?php echo base_url();?>admin/colecaofoto/pesquisar" class="">Fotos da coleção</a></li>                         		
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subNewsletter')"><a href="#" class="">Newsletter</a></h3>
                        <ul class="submenu" id="subNewsletter">                       
							<li><a href="<?php echo base_url();?>admin/newsletter/listar" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subBanner')"><a href="#" class="">Banner</a></h3>
                        <ul class="submenu" id="subBanner">                        	
							
							<li><a href="<?php echo base_url();?>admin/banner/manter" class="">Cadastar banner</a></li> 
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subEventos')"><a href="#" class="">Agenda de Eventos</a></h3>
                        <ul class="submenu" id="subEventos">                        	
							<li><a href="<?php echo base_url();?>admin/evento/listar" class="">Todos os eventos</a></li>  
							<li><a href="<?php echo base_url();?>admin/eventofoto/pesquisar" class="">Fotos da Evento</a></li> 
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subGaleriaImagem')"><a href="#" class="">Galeria de Imagens</a></h3>
                        <ul class="submenu" id="subGaleriaImagem">
							<li><a href="<?php echo base_url();?>admin/galeria/manter" class="">Nova Galeria</a></li>
							<li><a href="<?php echo base_url();?>admin/galeriafoto/pesquisar" class="">Fotos da Galeria</a></li> 							      					
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subNoticias')"><a href="#" class="">Noticias</a></h3>
                        <ul class="submenu" id="subNoticias">
                        	<li><a href="<?php echo base_url();?>admin/noticia/manter" class="">Cadastrar</a></li> 
							<li><a href="<?php echo base_url();?>admin/noticia/listar" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
                    <li><h3 onclick="SwitchMenu('subGaleriaVideo')"><a href="#" class="">Galeria de Vídeo</a></h3>
                        <ul class="submenu" id="subGaleriaVideo">                        	
							<li><a href="<?php echo base_url();?>admin/video/listar" class="">todos os vídeos</a></li>      							
                        </ul>
                    </li>
					
					<li><h3 onclick="SwitchMenu('subFale')"><a href="#" class="">Fale Conosco</a></h3>
                        <ul class="submenu" id="subFale"> 
							<li><a href="<?php echo base_url();?>admin/faleconosco/listar" class="">Todas as mensagens</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subLocalizacao')"><a href="#" class="">Localização</a></h3>
                        <ul class="submenu" id="subLocalizacao">                        	
							<li><a href="<?php echo base_url();?>admin/ondeestamos/listar" class="">Onde estamos</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subPerfilBabayala')"><a href="#" class="">Perfil Babayaha</a></h3>
                        <ul class="submenu" id="subPerfilBabayala">
                        	<li><a href="<?php echo base_url();?>admin/babayaga/manter" class="">Cadastrar</a></li> 
							<li><a href="<?php echo base_url();?>admin/babayaga/listar" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<!--
					<li><h3 onclick="SwitchMenu('subRedes')"><a href="#" class="">Redes Sociais</a></h3>
                        <ul class="submenu" id="subRedes">
						<li><a href="<?php echo base_url();?>admin/redesocial/listar" class="">Minhas redes</a></li>
                        	<li><a href="<?php echo base_url();?>admin/redesocial/manter" class="">Nova rede</a></li> 
							      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subParceiros')"><a href="#" class="">Parceiros</a></h3>
                        <ul class="submenu" id="subParceiros">                        
							<li><a href="<?php echo base_url();?>admin/parceiro/listar" class="">Todos os parceiros</a></li>      							
                        </ul>
                    </li>
					-->
					<li><h3 onclick="SwitchMenu('subAdmin')"><a href="#" class="">Administração</a></h3>
                        <ul class="submenu" id="subAdmin">
							<li><a href="<?php echo base_url();?>admin/usuario" class="">Novo usuário</a></li> 
                        	<!--
							<li><a href="<?php echo base_url();?>admin/" class="">Sesão</a></li> 
							<li><a href="<?php echo base_url();?>admin/" class="">Perfil</a></li> 
							-->
							<li><a href="<?php echo base_url();?>admin/usuario/detalhar/<?php echo $session_idUsuario;?>" class="">Mudar senha</a></li>      							
                        </ul>
                    </li>					
                    <li><a href="<?php echo base_url();?>admin/logout" class="">Sair [ X ]</a></li> 											
                   
					
				</ul>       
			</div>
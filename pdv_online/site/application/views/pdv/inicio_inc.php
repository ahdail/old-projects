<?php 
	$session_idUsuario = $this->session->userdata('id');
	$session_login = $this->session->userdata('login');
	$loginArray = explode(" ", $session_login);
	$loginSessao = $loginArray[0];
	checkLogin($session_login);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDV Lazer</title>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/theme.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/style.css" />

	<script type="text/javascript" src="<?php echo base_url()?>site/js/jquery-ui-1.8.2/js/jquery-1.4.2.js"></script>
	<link type="text/css" href="<?php echo base_url()?>site/js/jquery-ui-1.8.2/development-bundle/demos.css" rel="stylesheet" />

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
	   document.writeln('<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/theme3.css">');
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
<style>span {display:none;}</style>

</head>

<body>



	<div id="container">
    	<div id="header">
        	<p><img src="<?= base_url()?>site/img/babayaga.jpg" ></p>    
		</div>
        <div id="top-panel">
           <h3>Bem-vindo, Administrador</h3>
		</div>

		<div id="wrapper">
			<div id="sidebar">
  				<ul>
                	<li><h3 onclick="SwitchMenu('subQuemSomos')"><a href="#" class="">A empresa</a></h3>
                        <ul class="submenu" id="subQuemSomos">
                        	<li><a href="#" class="">Quem somos</a></li>                    		
                        </ul>
                    </li>
                    <li><h3 onclick="SwitchMenu('subColecao')"><a href="#" class="">Coleção</a></h3>
                        <ul class="submenu" id="subColecao">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>                    		
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subNewsletter')"><a href="#" class="">Newsletter</a></h3>
                        <ul class="submenu" id="subNewsletter">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subEventos')"><a href="#" class="">Agenda de Eventos</a></h3>
                        <ul class="submenu" id="subEventos">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subNoticias')"><a href="#" class="">Noticias</a></h3>
                        <ul class="submenu" id="subNoticias">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
                    <li><h3 onclick="SwitchMenu('subGaleria')"><a href="#" class="">Galeria de Vídeo</a></h3>
                        <ul class="submenu" id="subGaleria">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subFale')"><a href="#" class="">Fale Conosco</a></h3>
                        <ul class="submenu" id="subFale">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subLocalizacao')"><a href="#" class="">Localização</a></h3>
                        <ul class="submenu" id="subLocalizacao">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subPerfilBabayala')"><a href="#" class="">Perfil Babayaha</a></h3>
                        <ul class="submenu" id="subPerfilBabayala">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subRedes')"><a href="#" class="">Redes Sociais</a></h3>
                        <ul class="submenu" id="subRedes">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subParceiros')"><a href="#" class="">Parceiros</a></h3>
                        <ul class="submenu" id="subParceiros">
                        	<li><a href="#" class="">Cadastrar</a></li> 
							<li><a href="#" class="">Listar/Editar</a></li>      							
                        </ul>
                    </li>
					<li><h3 onclick="SwitchMenu('subAdmin')"><a href="#" class="">Administração</a></h3>
                        <ul class="submenu" id="subAdmin">
                        	<li><a href="#" class="">Sesão</a></li> 
							<li><a href="#" class="">Perfil</a></li>      							
							<li><a href="#" class="">Mudar senha</a></li>      							
                        </ul>
                    </li>
					
				</ul>       
			</div>
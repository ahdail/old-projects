<?php 
	$session_login = $this->session->userdata('login');
	$loginArray = explode(" ", $session_login);
	$loginSessao = $loginArray[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo base_url() ?>site/img/favicoCIC.ico">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="description" content="CIC - Centro Industrial do Ceará" />
<meta name="keywords" content="cic, fiec, centro indistrial do ceara, industria, ceará, ciclo de debates, obec" />

<title>Administração do CIC</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/admin.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
// Redimensiona o conteudo pra 100%
function resizeDivInicio() {
	var tamanho;
	if (window.innerHeight) { tamanho = window.innerHeight;	} 
	else { tamanho = document.body.offsetHeight; }
	$("#divConteudo").css("height",(tamanho - 120));
}

$(document).ready(function() { resizeDivInicio(); } );
$(window).resize( function() { resizeDivInicio(); } );


		/***********************************************
		* Switch Menu script- by Martial B of http://getElementById.com/
		* Modified by Dynamic Drive for format & NS4/IE4 compatibility
		* Visit http://www.dynamicdrive.com/ for full source code
		***********************************************/

		if (document.getElementById){ //DynamicDrive.com change
			document.write('<style type="text/css">\n')
			document.write('.submenu{display: none;}\n')
			document.write('</style>\n')
		}

		function SwitchMenu(obj){
			if(document.getElementById){
			var el = document.getElementById(obj);
			var ar = document.getElementById("divMenu").getElementsByTagName("ul"); //DynamicDrive.com change
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

</head>

<body>
<div id="divCorpo">
<!-- TOPO -->
<div id="divTopo">
	<img class="esq" src="<?php //echo base_url() ?>site/img/topoLogoCIC.gif" style="height: 93px;" alt="CIC" />
	<font style="color: #FFFFFF; padding-left: 30px;font-size: 14px;font-family: Arial;">
		Bem-vindo <b><?php echo $loginSessao?></b>
	</font>
</div>
<!-- MENU -->
<div id="divMenu">
	<ul>
		<li><h1 onclick="SwitchMenu('subConteudo')">Conteúdo</h1>
			<ul class="submenu" id="subConteudo">
				<li><a href="<?php echo base_url() ?>admin/conteudo/manter" target="conteudo">Adicionar</a></li>
				<li><a href="<?php echo base_url() ?>admin/conteudo" target="conteudo">Listar/Editar</a></li>
				<li><a href="<?php echo base_url() ?>admin/quemsomos" target="conteudo">Quem Somos</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subPodcasting')">PodCasting</h1>
			<ul class="submenu" id="subPodcasting">
				<li><a href="<?php echo base_url() ?>admin/podcasting/manter" target="conteudo">Adicionar</a></li>
				<li><a href="<?php echo base_url() ?>admin/podcasting" target="conteudo">Listar/Editar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subNovaPag')">Nova Página</h1>
			<ul class="submenu" id="subNovaPag">
				<li><a href="<?php echo base_url() ?>admin/novapagina" target="conteudo">Criar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subBanner')">Banner</h1>
			<ul class="submenu" id="subBanner">
				<li><a href="<?php echo base_url() ?>admin/banner/manter" target="conteudo">Adicionar</a></li>
				<li><a href="<?php echo base_url() ?>admin/banner" target="conteudo">Listar/Editar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subNews')">Newsletter</h1>
			<ul class="submenu" id="subNews">
				<li><a href="<?php echo base_url() ?>admin/newsletter/manter" target="conteudo">Cadastrar e-mail</a></li>
				<li><a href="<?php echo base_url() ?>admin/newsletter" target="conteudo">Listar/Editar e-mail</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subCiclo')">Ciclo de Debates</h1>
			<ul class="submenu" id="subCiclo">
				<li><a href="<?php echo base_url() ?>admin/cicloDebate/programaListar" target="conteudo">Programas</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subAgenda')">Agenda</h1>
			<ul class="submenu" id="subAgenda">
				<li><a href="<?php echo base_url() ?>admin/evento/manter" target="conteudo">Adicionar Evento</a></li>
				<li><a href="<?php echo base_url() ?>admin/evento" target="conteudo">Listar/Editar Evento</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subEnquete')">Enquete</h1>
			<ul class="submenu" id="subEnquete">
				<li><a href="<?php echo base_url() ?>admin/enquete/perguntaListar/0" target="conteudo">Perguntas</a></li>
				<li><a href="<?php echo base_url() ?>admin/enquete/todasPerguntas/" target="conteudo">Respostas</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subFaleConosco')">Fale Conosco</h1>
			<ul class="submenu" id="subFaleConosco">
				<li><a href="<?php echo base_url() ?>admin/faleConosco/detalhar" target="conteudo">Adicionar</a></li>
				<li><a href="<?php echo base_url() ?>admin/faleConosco/listar" target="conteudo">Listar/Editar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subAdministracao')">Administração</h1>
			<ul class="submenu" id="subAdministracao">
				<li><a href="<?php echo base_url() ?>admin/usuariodados" target="conteudo">Atualizar senha</a></li>
				<li><a href="<?php echo base_url() ?>admin/usuario" target="conteudo" target="">Usuários</a></li>
				<li><a href="<?php echo base_url() ?>admin/secao" target="conteudo">Sessão</a></li>
				<li><a href="<?php echo base_url() ?>admin/perfil" target="conteudo">Perfis</a></li>
				<li><a href="<?php echo base_url() ?>admin/auditoria" target="conteudo">Auditoria</a></li>
			</ul>
			<ul>
				<li><a href="<?php echo base_url() ?>admin/logout" target="" style="font-weight: bold">Sair [x]</a></li>
			</ul>
		</li>
	</ul>
</div>

<!-- CONTEï¿½DO -->
<div id="divConteudo">
	<iframe marginheight="0" frameborder="0" src="<?php echo base_url() ?>admin/conteudo" name="conteudo" id="conteudo"></iframe>
</div>

</div>
</body>

</html>
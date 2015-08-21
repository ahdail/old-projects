<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Henrique Gogó" />
<meta name="description" content="Portal da Classe Contábil" />
<meta name="keywords" content="classe contábil, portal, contador, contabilidade, fortes, grupo fortes" />

<title>Administração do Classe Contábil</title>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>v3/css/admin.css" />

<script language="javascript">
function alturaConteudo() {
 if (window.innerHeight) {
  var altura = (window.innerHeight - 120)+"px";
 } 
 else {
  var altura = (document.body.clientHeight - 120)+"px";
 }
 document.getElementById('divConteudo').style.height=altura;
}



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
	<img id="logo" src="<?= base_url()?>v3/i/topoLogo.gif" alt="Portal da Classe Contábil" onload="alturaConteudo()" />
</div>
<!-- MENU -->
<div id="divMenu">
	<ul>
		<li><h1 onclick="SwitchMenu('subBanners')">Banners</h1>
			<ul class="submenu" id="subBanners">
				<li><a href="../admin/banner/manter" target="conteudo">Incluir</a></li>
				<li><a href="../admin/banner/listar" target="conteudo">Listar/Editar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subBoletim')">Boletim Eletrônico</h1>
			<ul class="submenu" id="subBoletim">
				<li><a href="#" target="conteudo">Montar Boletim</a></li>
				<li><a href="#" target="conteudo">Listar/Editar</a></li>
				<li><a href="#" target="conteudo">Excluir</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subNoticias')">Noticias</h1>
			<ul class="submenu" id="subNoticias">
				<li><a href="#" target="conteudo">Cadastrar</a></li>
				<li><a href="#" target="conteudo">Listar/Editar</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subArtigos')">Artigos</h1>
			<ul class="submenu" id="subArtigos">
				<li><a href="#" target="conteudo">Novo</a></li>
				<li><a href="#" target="conteudo">Listar/Editar</a></li>
				<li><a href="#" target="conteudo">Avaliações</a></li>
				<li><a href="#" target="conteudo">Autores</a></li>
			</ul>
		</li>
		<li><h1 onclick="SwitchMenu('subConsultoria')">Consultoria Gratuita</h1>
			<ul class="submenu" id="subConsultoria">
				<li><a href="#" target="conteudo">Listar Consultores</a></li>
				<li><a href="#" target="conteudo">Ranking de Consultores</a></li>
				<li><a href="#" target="conteudo">Avaliações</a></li>
				<li><a href="#" target="conteudo">Autores</a></li>
			</ul>
		</li>
	
		<li><h1 onclick="SwitchMenu('subAdministracao')">Administração</h1>
			<ul class="submenu" id="subAdministracao">
				<li><a href="<?= base_url() ?>index.php/admin/usuarioDados/exibe" target="conteudo">Meus Dados</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/usuario/listar" target="conteudo" target="">Usuários</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/perfil/listar" target="conteudo">Perfis</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/permissao/listar" target="conteudo">Seções</a></li>
				<li><a href="<?= base_url() ?>index.php/admin/auditoria/listar" target="conteudo">Auditoria</a></li>
			</ul>
			<ul>
				<li><a href="#" target="" style="font-weight: bold">Sair [x]</a></li>
			</ul>
		</li>
	</ul>
</div>

<!-- CONTEÚDO -->
<div id="divConteudo">
	<iframe marginheight="0" frameborder="0" src="http://www.classecontabil.com.br/" name="conteudo" id="conteudo"></iframe>
</div>

</div>
</body>

</html>
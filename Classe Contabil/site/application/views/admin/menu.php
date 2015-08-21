<?php 
	$session_login = $this->session->userdata('login');
	$codigos = $this->session->userdata('codigos');
	$loginArray = explode(" ", $session_login);
	$loginSessao = $loginArray[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/admin.css" />

<script>
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
	var ar = document.getElementById("menu").getElementsByTagName("ul"); //DynamicDrive.com change
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

<body id="menu">

<ul>
	<li>
		<img src="http://www.classecontabil.com.br/v3/site/img/topoLogo.gif" width="135" style="border: 1px solid #199887" />
	</li>
	<li><br /></li>
	
	
	
	<li><h1 onclick="SwitchMenu('subArtigos')">Restaurante</h1>
		<ul class="submenu" id="subArtigos">
			<li><a href="<?php echo  base_url() ?>admin/restaurante/manter"" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/restaurante" target="conteudo">Listar/Editar</a></li>
		</ul>
	</li>
	
	<li><h1 onclick="SwitchMenu('subRestaurante')">Restaurante</h1>
		<ul class="submenu" id="subRestaurante">
			<li><a href="<?php echo  base_url() ?>admin/artigo/manter"" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/artigo" target="conteudo">Listar/Editar</a></li>
		</ul>
	</li>
	
	
	<?php if ($codigos["ART"]) { ?>
	<li><h1 onclick="SwitchMenu('subArtigos')">Artigos</h1>
		<ul class="submenu" id="subArtigos">
			<li><a href="<?php echo  base_url() ?>admin/artigo/manter" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/artigo" target="conteudo">Listar/Editar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/juizodiario" target="conteudo">Juízo Diário</a></li>
			<li><a href="<?php echo  base_url() ?>admin/neo/listar"" target="conteudo">Neopatrimonialismo</a></li>
			<li><a href="<?php echo  base_url() ?>" target="conteudo">Avaliações</a></li>
			<li><a href="<?php echo  base_url() ?>admin/autor/" target="conteudo">Autores</a></li>
			<li><a href="<?php echo  base_url() ?>admin/comentario/" target="conteudo">Comentários</a></li>
			<li><a href="<?php echo  base_url() ?>admin/trabalho" target="conteudo">Trabalho Acadêmicos</a></li>
		</ul>
	</li>
	<?php } if ($codigos["EXT"]) { ?>
	<li><h1 onclick="SwitchMenu('subExtras')">Extras</h1>
		<ul class="submenu" id="subExtras">
			<li><a href="<?php echo  base_url() ?>admin/dicas" target="conteudo">Dicas do Portal</a></li>
			<li><a href="<?php echo  base_url() ?>admin/depoimentos" target="conteudo">Depoimentos</a></li>
			<li><a href="<?php echo  base_url() ?>admin/loja" target="conteudo">Loja</a></li>
			<li><a href="<?php echo  base_url() ?>admin/faq" target="conteudo">FAQ</a></li>
		</ul>
	</li>
	<?php } if ($codigos["MODEL"]) {?>
	<li><h1 onclick="SwitchMenu('subModelo')">Contratos</h1>
		<ul class="submenu" id="subModelo">
			<li><a href="<?php echo  base_url() ?>admin/modelo/detalhar" target="conteudo">Adicionar Modelo</a></li>
			<li><a href="<?php echo  base_url() ?>admin/modelo" target="conteudo">Listar/Editar Modelo</a></li>
		</ul>
	</li>
	<?php } if ($codigos["PES"]) {?>
	<li><h1 onclick="SwitchMenu('subPesquisa')">Pesquisa</h1>
		<ul class="submenu" id="subPesquisa">
			<li><a href="<?php echo  base_url() ?>admin/pesquisa/pesquisaListar" target="conteudo">Pesquisa</a></li>
			<li><a href="<?php echo  base_url() ?>admin/pesquisa/todasPesquisas" target="conteudo">Perguntas</a></li>
			<li><a href="<?php echo  base_url() ?>admin/pesquisa/relatorio" target="conteudo">Montar Relátorio</a></li>
		</ul>
	</li>
	<?php } if ($codigos["DIC"]) {?>
	<li><h1 onclick="SwitchMenu('subDicionario')">Dicionário</h1>
		<ul class="submenu" id="subDicionario">
			<li><a href="<?php echo  base_url() ?>admin/dicionario" target="conteudo">Listar/Editar</a></li>
		</ul>
	</li>
	<?php } if ($codigos["TRAB"]) {?>
	<!--  <li><h1 onclick="SwitchMenu('subTrabalho')">Trabalho</h1>
		<ul class="submenu" id="subTrabalho">
			<li><a href="<?= base_url() ?>admin/trabalho/manter" target="conteudo">Adicionar Trabalho</a></li>
			<li><a href="<?= base_url() ?>admin/trabalho" target="conteudo">Listar/Editar Trabalho</a></li>
		</ul>
	</li>-->
	<?php } if ($codigos["AGE"]) { ?>
	<li><h1 onclick="SwitchMenu('subAgenda')">Eventos</h1>
		<ul class="submenu" id="subAgenda">
			<li><a href="<?php echo base_url() ?>admin/evento/manter" target="conteudo">Adicionar Evento</a></li>
			<li><a href="<?php echo base_url() ?>admin/evento" target="conteudo">Listar/Editar Evento</a></li>
		</ul>
	</li>
	<?php } if ($codigos["BAN"]) { ?>
	<li><h1 onclick="SwitchMenu('subBanners')">Banners</h1>
		<ul class="submenu" id="subBanners">
			<li><a href="<?php echo base_url()?>admin/banner/manter" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url()?>admin/banner" target="conteudo">Listar/Editar</a></li>
		</ul>
	</li>
	<?php } if ($codigos["BOL.E"]) { ?>
	<li><h1 onclick="SwitchMenu('subBoletim')">Boletim Eletrônico</h1>
		<ul class="submenu" id="subBoletim">
			<li><a href="<?php echo base_url() ?>admin/boletim/montar" target="conteudo">Montar Boletim</a></li>
			<li><a href="<?php echo base_url() ?>admin/boletim/ver_montado" target="conteudo">Ver/Enviar Boletim</a></li>
		</ul>
	</li>
	<?php } if ($codigos["CON.GRA"]) { ?>
	<li><h1 onclick="SwitchMenu('subConsultoria')">Consultoria Gratuita</h1>
		<ul class="submenu" id="subConsultoria">
			<li><a href="<?php echo base_url()?>admin/classificapergunta" target="conteudo">Classificar Perguntas</a></li>
			<li><a href="<?php echo base_url()?>admin/consultoresclasse" target="conteudo">Listar Consultores</a></li>
			<li><a href="#" target="conteudo">Ranking de Consultores</a></li>
			<li><a href="#" target="conteudo">Avaliações</a></li>
			<li><a href="<?php echo base_url()?>admin/temasconsultoria/listar" target="conteudo">Temas</a></li>
		</ul>
	</li>
	<?php } if ($codigos["NOT"]) { ?>
	<li><h1 onclick="SwitchMenu('subNoticias')">Notícias</h1>
		<ul class="submenu" id="subNoticias">
			<li><a href="<?php echo  base_url() ?>admin/noticia/manter" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/noticia" target="conteudo">Listar/Editar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/comentarionoticia" target="conteudo">Comentários</a></li>
			<li><a href="<?php echo  base_url() ?>admin/noticiafonte" target="conteudo">Fontes</a></li>
		</ul>
	</li>
	<?php } if ($codigos["TAG"]) { ?>
	<li><h1 onclick="SwitchMenu('subTag')">Tags</h1>
		<ul class="submenu" id="subTag">
			<li><a href="<?php echo  base_url() ?>admin/tag/detalhar/0" target="conteudo">Adicionar</a></li>
			<li><a href="<?php echo  base_url() ?>admin/tag/listar/0/0" target="conteudo">Listar/Editar</a></li>
		</ul>
	</li>
	<?php } if ($codigos["ENQ"]) { ?>
	<li><h1 onclick="SwitchMenu('subEnq')">Enquete</h1>
		<ul class="submenu" id="subEnq">
			<li><a href="<?php echo  base_url() ?>admin/enquete/perguntaListar/0" target="conteudo">Perguntas</a></li>
			<li><a href="<?php echo  base_url() ?>admin/enquete/todasPerguntas/" target="conteudo">Respostas</a></li>
			<li><a href="<?php echo  base_url() ?>admin/enquete/resultado/" target="conteudo">Resultado</a></li>
		</ul>
	</li>
	<?php } if ($codigos["MUL"]) { ?>
	<li><h1 onclick="SwitchMenu('subPod')">Multimidia</h1>
		<ul class="submenu" id="subPod">
			<li><a href="<?= base_url() ?>admin/podClasse/listar" target="conteudo">PodClasse Listar/Editar</a></li>
			<li><a href="<?= base_url() ?>admin/podClasse/comentario" target="conteudo">Comentários PodCasting</a></li>
			<li><a href="<?= base_url() ?>admin/video/" target="conteudo">Vídeos Listar/Editar</a></li>
			<li><a href="<?= base_url() ?>admin/video/comentario" target="conteudo">Comentários Vídeos</a></li>
		</ul>
	</li>
	<?php } if ($codigos["USER"]) { ?>
	<li><h1 onclick="SwitchMenu('subMeu')">Meu Classe</h1>
		<ul class="submenu" id="subMeu">
			<li><a href="<?php echo  base_url() ?>admin/usuariosClasse/" target="conteudo">Usuários</a></li>
		</ul>
	</li>
	<li><h1 onclick="SwitchMenu('subAdministracao')">Administração</h1>
		<ul class="submenu" id="subAdministracao">
			<?php } if ($codigos["ADM.SEN"]) { ?>
			<li><a href="<?php echo  base_url() ?>admin/usuariodados" target="conteudo">Meus Dados</a></li>
			<?php } if ($codigos["ADM.USR"]) { ?>
			<li><a href="<?= base_url() ?>admin/usuario" target="conteudo" target="">Usuários</a></li>
			<?php } if ($codigos["ADM.PER"]) { ?>
			<li><a href="<?php echo  base_url() ?>admin/perfil" target="conteudo">Perfis</a></li>
			<?php } if ($codigos["ADM.SEC"]) { ?>
			<li><a href="<?php echo  base_url() ?>admin/secao" target="conteudo">Sessões</a></li>
			<?php } if ($codigos["ADM.AUD"]) { ?>
			<li><a href="<?php echo  base_url() ?>admin/auditoria" target="conteudo">Auditoria</a></li>
			<?php } ?>
		</ul>
		<ul>
			<li><a href="<?php echo  base_url() ?>admin/logout" target="admin" style="font-weight: bold">Sair [x]</a></li>
		</ul>
	</li>
</ul>

</body>

</html>
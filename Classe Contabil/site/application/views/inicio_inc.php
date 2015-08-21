<?php
	#############################################################################################################
	// Dados do Usuário na Session
	$session_idUsuario = $this->session->userdata('idUsuario'); 			// Id do Usuário
	$session_login = $this->session->userdata('nome'); 						// Nome
	$session_email = $this->session->userdata('email');						// Email
	$session_consultor = $this->session->userdata('consultor');				// Consultor
	$session_data = $this->session->userdata('ultimoAcesso');
	$session_avatar = $this->session->userdata('avatar');
	$AcessoArray = explode(" ", $session_data);
	$acessoDataSessao =  $AcessoArray[0];									// Data último Acesso

	$dataAtual = date("d/m/Y");// Data Atual
	$horaAtual = date("H:i:s");// Hora Atual

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Portal da Classe Contábil" />
<meta name="keywords" content="classe contábil, portal, contador, contabilidade, fortes, grupo fortes" />

<title>Portal da Classe Contábil</title>

<link rel="shortcut icon" href="<?php echo base_url()?>site/img/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/classe.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/dicionario.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.form.js"></script>
<script language="javascript" type="text/javascript">
	function alternaNoticias() {
		$('#notUltimas').add('#notMaisAcessados').toggle();
		//$('').toggle();
	}

	function alternaVideos() {
		$('#videoUltimas').add('#videoMaisAcessados').toggle();
		//$('').toggle();
	}

	function alternaArtigos(){
		$('#artUltimas').add('#artMaisAcessados').toggle();
	}

</script>
<script language="JavaScript" type="text/JavaScript">
//Specify affected tags. Add or remove from list:
var tgs = new Array( 'p' );

//Specify spectrum of different font sizes:
var szs = new Array( 'xxx-small','xx-small','x-small','small','medium','large','x-large','xx-large', 'xxx-large' );
var startSz = 2;

function ts( trgt,inc ) {
	if (!document.getElementById) return
		var d = document,cEl = null,sz = startSz,i,j,cTags;
		sz += inc;
		if ( sz < 0 ) sz = 0;
		if ( sz > 6 ) sz = 6;
		startSz = sz;
		if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];

		cEl.style.fontSize = szs[ sz ];

	for ( i = 0; i < tgs.length; i++ ) {
		cTags = cEl.getElementsByTagName( tgs[ i ] );
		for ( j = 0; j < cTags.length; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
	}
}

function mostrar() {
	obj1 = document.getElementById("autor");
	if (obj1.style.display=='block') {
		obj1.style.display='none';
	} else {
		obj1.style.display='block';
	}
}

var bookmarkurl=document.location
var bookmarktitle=document.title

function addFav(){
	var url      = "http://www.classecontabil.com.br";
	var title    = "Classe Contábil - O seu Portal sobre Contabilidade";
	if (window.sidebar) window.sidebar.addPanel(title, url,"");
	else if(window.opera && window.print){
		var mbm = document.createElement('a');
		mbm.setAttribute('rel','sidebar');
		mbm.setAttribute('href',url);
		mbm.setAttribute('title',title);
		mbm.click();
	}
	else if(document.all){window.external.AddFavorite(url, title);}
}

</script>

<!-- // Indique um Amigo  -->
<script>
<!-- // Comentário  -->

function comentar() {
	var obj1 = document.getElementById("comentarForm");
	var obj2 = document.getElementById("indicarForm");
	if (obj1.style.display=='block') {
		obj1.style.display='none';
	} else {
		obj1.style.display='block';
		obj2.style.display='none';
	}
}

<!-- // Indique  -->
function indicar() {
	var obj1 = document.getElementById("comentarForm");
	var obj2 = document.getElementById("indicarForm");
	if (obj2.style.display=='block') {
		obj2.style.display='none';
	} else {
		obj2.style.display='block';
		obj1.style.display='none';
	}
}
<!-- // Mascará para Telefone  -->
	function mascara(o,f){
	    v_obj=o
	    v_fun=f
	    setTimeout("execmascara()",1)
	}
	function execmascara(){
	    v_obj.value=v_fun(v_obj.value)
	}

	function telefone(v){
	    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
	    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
	    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
	    return v
	}
	// Calculos Financeiros
	function cf() {
		path = 'http://www.classecontabil.com.br/calcfin/index.php';
		var remote = null;
		remote = window.open(path,'calcfin','toolbar=no,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=804,height=540')
	}

</script>
</head>

<body>

<!-- DIV DE EXIBIÇÃO DAS PALAVRAS DO DICIONÁRIO -->



<div id="divPalavra" style="font-size: 11px; color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; display:none; position:absolute; z-index: 300; width: 280px; background-color:#EAEAEA; border: 1px solid #295CA0; padding:2px; opacity:0.9; -moz-opacity: 0.9; filter: alpha(opacity=90);-moz-border-radius: 10px; -webkit-border-radius: 10px;"></div>

<div id="divGog">

<!-- DIV CORPO QUE VAI ENGLOBAR TOPO MENU E CONTEï¿½DO -->
<div id="divCorpo">

<!-- BANNER TOPO -->
<div id="divBannerTopo">
	<?php
		if ($banner1) {
			$banner = $banner1;
		}
		if ($banner4) {
			$banner = $banner4;
		}
		if ($banner) {
			foreach ($banner as $row) {
				$caminho = base_url()."site/banners/".$row[arquivo];
					if ($row['tipo'] == 1) {
						echo "
							<embed
								src=$caminho
								width=$row[largura]
								height=$row[altura]
								allowscriptaccess=always
								allowfullscreen=true
							</embed>";
					} else {
						$url = $row['url'];
						if ($row['novaJanela'] == "S"){
							$target = "target = _blank";
						} else {
							$target = "";
						}
						echo "<a href=".base_url()."click/contadorClick/$row[id] $target><img src=$caminho width=$row[largura] height=$row[altura] border=\"0\"></a>";
					}
			}
		} else {?>
			<img src="<?php echo base_url()?>site/img/bannerfull468x60.gif" border="0" width="100%" height="94" />
		<?php }	?>
</div>

<!-- TOPO -->
<div id="divTopo">
	<a href="<?php echo base_url() ?>"><img border="0" id="logo" src="<?php echo base_url()?>site/img/topoLogo.gif" alt="Portal da Classe Contábil" /></a>
	<div id="divCabecalho">
		<!-- TOPO > Menu superior -->
		<ul id="menu">
			<li><a href="<?php echo base_url()?>consultoria">Consultoria </a></li>
			<li class="claro"><a href="<?php echo base_url()?>noticias">Notícias</a></li>
			<li><a href="<?php echo base_url()?>artigos">Artigos</a></li>
			<li class="claro"><a href="<?php echo base_url()?>anuncie">Anuncie no Classe</a></li>
		</ul>
		<!-- TOPO > Login -->
		<form id="login" action="<?php echo base_url()?>login/validar" method="post">
			<p>Login
			<input id="campoUsuario" name="email" value="e-mail" /> Senha
			<input id="campoSenha" type="password" name="senha" value="senha" />
			<input id="botEntrar" type="submit" value="entrar" />
			</p>
		</form>
		<!-- TOPO > Buscar -->
		<!--  <form id="buscar" action="<?php echo base_url()?>busca/" method="post">
			<p><img id="lupa" src="<?php echo  base_url()?>site/img/topoLupa.gif" />
			<input id="campoPalavra" name="busca" value="<?=$this->input->post('busca')?>" type="text" />
			<input id="botBuscar" type="submit" value="buscar" /></p>
		</form>-->
		<form id="buscar" action="http://google.com/cse" target=_blank>
			<p><img id="lupa" src="<?php echo  base_url()?>site/img/topoLupa.gif" />
			<input type="hidden" name="cx" value="000928093608285110664:6wqexp4veva" />
			<input type="hidden" name="cof" value="FORID:9" />
			<input  id="campoPalavra" type="text" name="q" value="busca">
			<input id="botBuscar" type="submit" value="buscar" /></p>
		</form>
		<!-- TOPO > Menu rápido -->
		<ul id="menuRapido">
			<li id="meuclasse">
			<?php if ($session_idUsuario) {?>
				<a href="<?=base_url()?>usuarios/meuClasse/">Meu Classe</a>
			<?php } else {?>
				<a href="<?=base_url()?>login/validar">Meu Classe</a>
			<?php }?>
			</li>
			<li id="cadastrese"><a href="<?php echo  base_url()?>login/cadastrar/">Cadastre-se</a></li>
			<li id="esquecisenha"><a href="<?php echo  base_url()?>login/esqueciMinhaSenha">Esqueci minha senha</a></li>
			<li id="twitter"><a href="http://twitter.com/classecontabil" target="_blank">Siga-nos no Twitter</a></li>
			<li id="orkut"><a href="http://www.orkut.com.br/Community.aspx?cmm=90718027&mt=7" target="_blank">Orkut</a></li>
			<li id="rss"><a href="<?php echo base_url()?>rss">RSS</a></li>
		</ul>
	</div>
</div>

<!-- LOGIN -->
<div id="divLogin">
	<?php
	if ($session_idUsuario){
		$dataUltimoAcesso= sqlToDate2($acessoDataSessao);
		//if (!isUsuarioValido)
		?>
		<p>Seja bem-vindo(a) <a href="<?php echo  base_url()?>usuarios/meuClasse/"><?=$session_login ?></a> - Seu último acesso foi dia <?=$dataUltimoAcesso?> [<a href="<?php echo base_url()?>login/logout/">Sair</a>]</p>
		<?php
	} else {
		?>
		<style>#divLogin { background: url("<?php echo base_url()?>site/img/topoBase.gif") no-repeat; }</style>
		<?php
	}
	?>
</div>

<!-- MENU -->

<div id="divMenu">
	<ul>
        <li><h1>Consultoria Gratuita</h1>
		<ul>
			<li><a href="<?php echo base_url()?>consultoria">Perguntas</a></li>
			<li><a href="<?php echo base_url()?>consultores">Consultores</a></li>
			<?php if (!$session_consultor) { ?>
				<li><a href="<?php echo base_url()?>login/cadastrarConsultor">Seja Consultor</a></li>
			<?php } ?>
		</ul>
		</li>
        <li><h1>Notícias</h1>
		<ul>
			<li><a href="<?php echo base_url()?>noticias">Ver Notícias</a></li>
			<li><a href="<?php echo base_url() ?>boletim">Boletim Eletrônico</a></li>
		</ul>
		</li>
		<li><h1>Artigos</h1>
		<ul>
			<li><a href="<?php echo base_url()?>autores">Articulistas</a></li>
			<li><a href="<?php echo base_url()?>artigos">Ver Artigos</a></li>
            <li><a href="<?php echo base_url()?>neo">Neopatrimonialismo</a></li>
			<li><a href="<?php echo base_url()?>trabalho">Acadêmicos</a></li>
			<li><a href="<?php echo base_url()?>trabalho/formEnvioTrabalho">Publique</a></li>
        </ul>
		</li>
		<li><h1>Multimídia</h1>
		<ul>
			<li><a href="<?php echo base_url() ?>pod">PodCasting</a></li>
			<li><a href="<?php echo base_url() ?>video">Vídeos</a></li>
		</ul>
		</li>
		<!--  <li><h1>Blogs <font style="color: red; font-weight: normal"><small>(novo)</small></font></h1>-->
		<li><h1>Blogs</h1>
		<ul>
			<li><a href="http://neopatrimonialismo.blogspot.com/" target=" _BLANK "> Ant° Lopes de Sá</a></li>
			<li><a href="http://josecarlosfortes.blogspot.com/" target=" _BLANK ">José<span style="color: #f6f6f6">.</span>Carlos<span style="color: #fbfbfb">.</span>Fortes</a></li>
		</ul>
		</li>
		<li><h1>Serviços</h1>
		<ul>
            <li><a href="<?php echo base_url()?>calculos">Cálculos</a></li>
			<li><a href="<?php echo base_url()?>dicionario">Dicionário</a></li>
			<li><a href="<?php echo base_url()?>eventos/divulgar">Divulgar Evento</a></li>
            <li><a href="<?php echo base_url()?>modelo">Modelos</a></li>
			<li><a href="<?php echo base_url()?>pesquisas">Pesquisas</a></li>
			<li><a href="http://www.fortesinformatica.com.br/v3/pae.php " target="_blank">PAE</a></li>
		</ul>
		</li>
        <li><h1>Contato</h1>
		<ul>
			<li><a href="<?php echo base_url()?>anuncie">Anuncie</a></li>
			<li><a href="<?php echo base_url()?>expediente">Expediente</a></li>
            <li><a href="http://www.grupofortes.com.br/" target="_blank">Grupo Fortes</a></li>
            <li><a href="<?php echo base_url()?>faq">Dúvidas<span style="color: #f6f6f6">.</span>Frequentes</a></li>
            <li><a href="<?php echo base_url()?>falecom">Fale Conosco</a></li>
		</ul>
		</li>

	</ul>
</div>



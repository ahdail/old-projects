<?php 
	$session_idUsuario = $this->session->userdata('id');
	$session_login = $this->session->userdata('login');
	//$loginArray = explode(" ", $session_login);
	//$loginSessao = $loginArray[0];
	checkLogin($session_login);	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CSM - Câmara de Horizonte</title>
  <link rel="stylesheet" href="<? echo base_url()?>css/base.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="<? echo base_url()?>css/default/style.css" type="text/css" media="screen" />
  <script type="text/javascript" charset="utf-8" src="<? echo base_url()?>js/jquery-1.3.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="<? echo base_url()?>js/jquery.scrollTo.js"></script>
  <script type="text/javascript" charset="utf-8" src="<? echo base_url()?>js/jquery.localscroll.js"></script>
  <script type="text/javascript" charset="utf-8">
    // <![CDATA[
    var Theme = {
      activate: function(name) {
        window.location.hash = 'themes/' + name
        Theme.loadCurrent();
      },

      loadCurrent: function() {
        var hash = window.location.hash;
        if (hash.length > 0) {
          matches = hash.match(/^#themes\/([a-z0-9\-_]+)$/);
          if (matches && matches.length > 1) {
            $('#current-theme').attr('href', 'css/' + matches[1] + '/style.css');
          } else {
            alert('theme not valid');
          }
        }
      }
    }

    $(document).ready(function() {
      Theme.loadCurrent();
      $.localScroll();
      $('.table :checkbox.toggle').each(function(i, toggle) {
        $(toggle).change(function(e) {
          $(toggle).parents('table:first').find(':checkbox:not(.toggle)').each(function(j, checkbox) {
            checkbox.checked = !checkbox.checked;
          })
        });
      });
    });
    // ]]>
  </script>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><a href="#">CMS - Câmara de Horizonte</a></h1>
      <div id="user-navigation">
        <ul class="wat-cf">
         <!-- <li><a href="#">Bem-vindo Admin</a></li>-->
          <li><a class="logout" href="#">Sair</a></li>
        </ul>
      </div>
      <div id="main-navigation">
        <ul class="wat-cf">
			<li class="first"><a href="<?php echo base_url();?>admin/noticia/listar">Notícias</a></li>			
			<li class="first"><a href="<?php echo base_url();?>admin/banner">Banner</a></li>
          <li class="first"><a href="<?php echo base_url();?>admin/comissao/listar">Comissões</a></li>
          <li><a href="<?php echo base_url();?>admin/vereadores/listar">Vereadores</a></li>
          <li><a href="<?php echo base_url();?>admin/camara/listar">A Câmara</a></li>
          <li><a href="<?php echo base_url();?>admin/lei/listar">Lei & Legislação</a></li>
		  <li><a href="<?php echo base_url();?>admin/transparencia/listar">Câmara Transparente</a></li>
		  <li><a href="<?php echo base_url();?>admin/apoio/listar">Apoio & Parceiros</a></li>
		  <li><a href="<?php echo base_url();?>admin/foto">Fotos</a></li>
		  <li><a href="<?php echo base_url();?>admin/vozcidadao">Voz do Cidadão</a></li>
		  <li><a href="<?php echo base_url();?>admin/redesocial/listar">Redes Sociais</a></li>
		  <li><a href="<?php echo base_url();?>admin/enquete">Enquete</a></li>
        </ul>
      </div>
    </div>
	 <div id="wrapper" class="wat-cf">
      <div id="main">
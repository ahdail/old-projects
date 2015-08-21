<?php 

$session_idUsuario = $this->session->userdata('id');
$session_login = $this->session->userdata('login');

checkLogin($session_login);	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciado de conteudo</title>


	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/demos/demos.css">
	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/themes/base/jquery.ui.datepicker.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/themes/base/jquery.ui.theme.css" type="text/css">

	<!-- Main Controlling Styles -->
	<link href="<?php echo base_url();?>css/admin/main.css" rel="stylesheet" type="text/css" />
	<!-- Blue Theme Styles -->
	<link href="<?php echo base_url();?>themes/blue/styles.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/jquery-1.7.1.js"></script>
	
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
	

	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
	
	<script src="<?php echo base_url();?>js/validate/jquery.validate.js"></script>
	
	
	<script src="<?php echo base_url();?>js/datatable/media/js/jquery.dataTables.js"></script>
	
	
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('#id_table_noticia').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",	
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": true,
			"bSort": false,
			"bInfo": true,
			"bAutoWidth": false,
			
			"oLanguage": {
				"sProcessing":   "Processando...",
				"sLengthMenu":   "Mostrar _MENU_ registros",
				"sZeroRecords":  "N&atilde;o foram encontrados resultados",
				"sInfo":         "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
				"sInfoEmpty":    "Mostrando de 0 at&eacute; 0 de 0 registros",
				"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"oPaginate": {
					"sFirst":    "Primeiro",
					"sPrevious": "Anterior",
					"sNext":     "Seguinte",
					"sLast":     "&Uacute;ltimo"
				},
			},
			
			"aoColumnDefs": [
                        { "bSearchable": true, "bVisible": true, "aTargets": [ 3 ] },
                        { "bVisible": false, "aTargets": [ 3 ] }
                    ] 
			
		});
	} );
</script>
	
<script type="text/javascript">
	$(function() {
		//$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
		$( "#data" ).datepicker({dateFormat: 'dd/mm/yy'});
	});
</script>	
	



</head>
<body>


		


<!-- Top header/black bar start -->
	<div id="header">
    	<img src="<?php echo base_url();?>images/admin/logo.png" alt="AdminCP" class="logo" />
        <!--
		<div id="searchbox">
        	<input type="text" class="searchinput" />
            <input type="image" src="<?php echo base_url();?>images/admin/search_btn.png" class="searchbtn" />
    	</div>
		--->
    </div>
 <!-- Top header/black bar end -->   
    
<!-- Left side bar start -->
        <div id="left">
<!-- Left side bar start -->

<!-- Toolbox dropdown start -->
        	<div id="openCloseIdentifier"></div>
            <!--
			<div id="slider">
                <ul id="sliderContent">
                    <li><a href="#" title="">Change Username</a></li>
                    <li class="alt"><a href="#" title="">Change Password</a></li>
                    <li><a href="#" title="">Change Address</a></li>
                    <li class="alt"><a href="#" title="">Payment Details</a></li>
                    <li><a href="#" title="">Log Out</a></li>
                </ul>
                <div id="openCloseWrap">
                    <div id="toolbox">
            			<a href="#" title="Toolbox Dropdown" class="toolboxdrop">Toolbox <img src="./../images/admin/icon_expand_grey.png" alt="Expand" /></a>
            		</div>
                </div>
            </div>
			-->
<!-- Toolbox dropdown end -->   
    	
<!-- Userbox/logged in start -->
            <div id="userbox" style="top:10px">
            	<p>Bem-vindo <?php echo $session_login;?></p>
                <!--<p><span>vocês está logado como Admin</span></p>-->
                <ul>
                	<li><a href="#" title="Check Mail"><img src="<?php echo base_url();?>images/admin/icons/icon_mail.png" alt="Mail" /></a></li>
                    <li><a href="#" title="Configure"><img src="<?php echo base_url();?>images/admin/icons/icon_cog.png" alt="Configure" /></a></li>
                    <li><a href="<?= base_url()?>admin/logout" title="Logout"><img src="<?php echo base_url();?>images/admin/icons/icon_unlock.png" alt="Sair" /></a></li>
                </ul>
            </div>
<!-- Userbox/logged in end -->  

<!-- Main navigation start -->         
            <ul id="nav" style="top:110px; display: block">
            	
				<li>
                    <a class="collapsed heading">Categorias</a>
                     <ul class="navigation">
                       <li><a href="<?php echo base_url();?>admin/pagina/categoria#form" title="">[Nova Categoria]</a></li>
						
						<?php foreach ($categorias as $row) {?>
                        
						<li><a href="<?php echo base_url();?>admin/categoria/detalhar/<?php echo $row['id_categoria']?>#form" title=""><?php echo $row['nome_categoria']?></a></li>
                       
						<?php } ?> 
						
                    </ul>
                </li>   
				
                
                
            </ul>
        </div>      
<!-- Main navigation end --> 

<!-- Left side bar start end -->   

<!-- Right side start -->     
        <div id="right">

<!-- Breadcrumb start -->  
            <!--
			<div id="breadcrumb">
                <ul>	
        			<li><img src="./../images/admin/icon_breadcrumb.png" alt="Location" /></li>
                    <li><a href="#" title="">Sub Section</a></li>
                    <li>/</li>
                    <li class="current">Control Panel</li>
                </ul>
            </div>
			--->
<!-- Breadcrumb end -->  

<!-- Top/large buttons start -->  
            <ul id="topbtns">
            	<!--<li class="desc"><strong>Quick Links</strong><br />Popular shortcuts</li>-->
                
				
				
				
                <li>
                	<a href="<?php echo base_url();?>admin/pagina/noticia"><img src="<?php echo base_url();?>images/admin/icons/icon_lrg_create.png" alt="Create" /><br />Notícias</a>
                </li>
					
                
				
				<li>
                	<a href="<?php echo base_url();?>admin/pagina/album"><img src="<?php echo base_url();?>images/admin/icons/folder_album.png" alt="Comment" /><br />Criar Album</a>
                </li>
                <li>
                	<a href="<?php echo base_url();?>admin/pagina/galeria"><img src="<?php echo base_url();?>images/admin/icons/icon_lrg_media.png" alt="Media" /><br />Fotos</a>
                </li>
				<!--
				<li>
                	<a href="<?php echo base_url();?>admin/pagina/categoria"><img src="<?php echo base_url();?>images/admin/icons/icon_lrg_calendar.png" alt="Calendar" /><br />Categoria</a>
                </li>
               			  
				<li>
                	<a href="<?php echo base_url();?>admin/pagina/secretaria"><img src="<?php echo base_url();?>images/admin/icons/secretaria.png" alt="Users" /><br />Secretaria</a>
                </li>
                -->
				<li>
                	<a href="<?php echo base_url();?>admin/pagina/banner"><img src="<?php echo base_url();?>images/admin/icons/bann.png" alt="Users" /><br />Banners</a>
                </li>
            </ul>
<!-- Top/large buttons end -->  
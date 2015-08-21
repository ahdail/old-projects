<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cleanity</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/demo_page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-ui-1.8.4.custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/jquery.wysiwyg.css" />

    <link type="text/javascript" href="<?php echo base_url();?>js/colorbox.css" />
    <link type="text/javascript" href="<?php echo base_url();?>js/colorbox-custom.css" />
    
		<style type="text/css">
        div.wysiwyg ul.panel li {padding:0px !important;} /**textarea visual editor padding override**/
        </style>
        <!--[if IE 6]>
        <link rel="stylesheet" href="ie.css" type="text/css" />
        <![endif]-->
        <!--[if IE]>
                    <link type="text/css" media="screen" rel="stylesheet" href="js/colorbox-custom-ie.css" title="Cleanity" />
        <![endif]-->

	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.treeview/lib/jquery.cookie.js" ></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.treeview/jquery.treeview.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.6.2.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.colorbox-min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.ui.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.corners.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/bg.pos.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.wysiwyg.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/tabs.pack.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/cleanity.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.filestyle.js" ></script>
    
    
    <!-------------------------------- DATATABLE ------------------------------------>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/datatable/media/js/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/datatable/media/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/datatable/media/js/datatables.js" ></script>
    
	
    
	<script type="text/javascript" charset="utf-8">
		  $(function() {
					
			  $("input.file_1").filestyle({ 
				  image: "images/btn-input-file.png",
				  imageheight : 23,
				  imagewidth : 55,
				  width : 102
			  });
		  });
	</script>
    
  <!-- <script>
		$(document).ready(function() {
						oTable = $('#groceryCrudTable1').dataTable({
							"bJQueryUI": true,
							"sPaginationType": "full_numbers",
							"aLengthMenu": [[05], [05]],
							"iDisplayLength": 5,
						});
					});
	</script>
    
    <script>
		$(document).ready(function() {
						oTable = $('#groceryCrudTable2').dataTable({
							"bJQueryUI": true,
							"sPaginationType": "full_numbers",
							"aLengthMenu": [[05], [05]],
							"iDisplayLength": 5,
					});
				});
	</script> -->
    
    <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#groceryCrudTable1').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
	</script>
    
    <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#groceryCrudTable2').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
	</script>
    <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#groceryCrudTable3').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
	</script> 
    


</head>

<body>
<div id="container">
    <div class="hidden"><!-- the modal box container - this div is hidden until it is called from a modal box trigger. see cleanity.js for details -->
    <div id="sample-modal"><h2 style="font-size:160%; font-weight:bold; margin:10px 0;">Modal Box Content</h2><p>Place your desired modal box content here</p></div>
    </div><!-- end of hidden -->
    <div id="header">
      <div id="top">
      <h1><a href="<?php echo base_url()?>">Esmaltec S/A</a></h1>
      <p id="userbox">Olá <strong>José da Silva</strong> &nbsp;| &nbsp;<a href="#">Meus Dados</a> &nbsp;| &nbsp;<a href="#">Sair</a> <br />
      <small>Seu último acesso foi em 12 Fev 2010</small></p>
      <span class="clearFix">&nbsp;</span>
      </div>
      <ul id="menu">
        <li class="selected"><a href="<?php echo base_url()?>">Início</a></li>
        <li><a class="top-level" href="#">Usuários <span>&nbsp;</span></a>
          <ul>
            <li><a href="<?php echo base_url()?>usuarios">Cadastrar </a></li> 			
          </ul>
        </li>
        <li><a class="top-level" href="<?php echo base_url()?>noticias">Notícias <span>&nbsp;</span></a>
            <ul>
            <li><a href="<?php echo base_url()?>noticias">Cadastrar</a></li>
            
          </ul></li>
      </ul>
	 <form action="" method="get" name="form1" id="form1">
      <fieldset>
      <legend>Search</legend>
        <label id="searchbox">
        <input type="text" name="s" id="s" />
        </label>
        <input class="hidden" type="submit" name="Submit" value="Search" />
      </fieldset>
      </form>
      <span class="clearFix">&nbsp;</span>
    </div><!-- end of #header -->

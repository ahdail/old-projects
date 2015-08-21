<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Portal da Classe Contábil" />

<title>Administração do Classe Contábil</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/admin.css" />

</head>

<body>

<div id="dock">
<div class="bordaEsq"></div>
	<a href="<?php echo  base_url()?>/admin/noticia/manter" target="conteudo"><img src="<?php echo  base_url()?>site/img/admin/icoNot.png" alt="Adicionar notícias" /></a>
	<a href="<?php echo  base_url()?>/admin/artigo/manter" target="conteudo"><img src="<?php echo base_url()?>site/img/admin/icoArt.png" alt="Adicionar artigos" /></a>
	<a href="<?php echo  base_url()?>/admin/consultoresclasse" target="conteudo"><img src="<?php echo base_url()?>site/img/admin/icoConsult.png" alt="Validar novos consultores" /></a>
	<a href="<?php echo  base_url()?>/admin/depoimentos" target="conteudo"><img src="<?php echo base_url()?>site/img/admin/icoDepo.png" alt="Validar novos depoimentos" /></a>
	<a href="<?php echo  base_url()?>/admin/comentarionoticia" target="conteudo"><img src="<?php echo base_url()?>site/img/admin/icoComent.png" alt="Validar comentários de notícias" /></a>
<div class="bordaDir"></div>
</div> <!-- Fim de dock -->

<iframe id="admin" src="<?php echo base_url()?>admin/admin" marginheight="0" marginwidth="0" frameborder="0" width="100%" height="100%"></iframe>

</body>

</html>
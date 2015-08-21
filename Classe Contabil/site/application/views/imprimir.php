<?php 
function sqlToDate($data)
{
	$nova_data = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
	return $nova_data;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Preparado para Impressão</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<style>
#divConteudo {
	position: absolute;
	left: 0;
	width: 100%;
	font-family: Verdana, Arial, Helvetica, sans-serif;	
	border: none;
}
</style>
<!-- CONTEÚDO -->
<img border="0" id="logo" src="<?php echo base_url()?>site/img/topoLogo.gif" alt="Portal da Classe Contábil" /><br /><br />
<div id="divConteudo">
<?php if($secao == "not"){?>
	<h1 class="titulo"><?php if ($secao == "not"){ echo "Notícia";} ?></h1>
	<?php $dataNoticia = sqlToDate($imprimir['data']);?>
	<div id="divOpcoes">
		<span id="data" class="esq"><?php echo $dataNoticia?></span>
	</div>
		<h1><?php echo $imprimir['titulo']?></h1>
		<div id="corpo"><p><?php echo $imprimir['conteudo']?></p></div>
		<?php 
		if ($imprimir['fonte']){
			$fonte = $imprimir[fonte];
			$siteFonte = $imprimir[siteFonte];?> 
			<a class="fonte" href="<?php echo $siteFonte?>" target="_blank">Fonte: <?php echo $fonte?></a>
		<?php }?>
<?php } if ($secao == "juizo") { // Juízo Diário?>
	<h1 class="titulo"><?php if($secao) { echo "Juizo Diário"; }?></h1>
		<h1><?php echo $imprimir['pergunta']?></h1>
		<div id="corpo"><p><?php echo $imprimir['resposta']?></p></div>
		<?php 
		if ($imprimir['fonte']){
			$fonte = $imprimir[fonte];
			$siteFonte = $imprimir[siteFonte];?> 
			<a class="fonte" href="<?= $siteFonte?>" target="_blank">Fonte: <?=$fonte?></a>
		<?php }?>
<?php } if ($secao == "art") { // Artigo?>
	<h1 classe="titulo"><?php if ($secao == "art" && $imprimir['tipo'] != "D") { echo "Artigo"; } else { echo "Direito Empresarial";}?></h1>
	<?php $dataArtigo = sqlToDate($imprimir['data']);?>
	<div id="divOpcoes">
		<span id="data" class="esq"><?php echo $dataArtigo ?></span>
	</div>
		<h1><?php echo $imprimir['titulo']?></h1>
		<div id="corpo"><p><?php echo $imprimir['conteudo']?></p></div>
<?php }?>	
	<div id="divOpcoes"><center><p>Esta e outras matérias você encontra no Portal da Classe Contábil.<br /><b>www.classecontabil.com.br</b></p></center></div>
</div>
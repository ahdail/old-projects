<?php 
if ($session_email){
	$linkEnviar = "javascript:indicar();";
	$linkEnviarTopo = $linkEnviar;
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkEnviar = base_url()."login";
	$linkEnviarTopo = $linkEnviar;
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<!-- CONTEÚDO -->
<div id="divConteudo">
		<h1 class="titulo">Modelos de Contratos</h1>
		<div id="divOpcoes">
			<span id="opcoes">
				<ul>
					<li id="enviar"><a href="<?php echo $linkEnviarTopo?>">Contribua com o portal enviando seu modelo.</a></li>
				</ul>
			</span>
		</div>
		<!-- Exibir o Formulário de indicacao [envie para um Amigo]  -->
		<form id="formIndicacao" action="<?php echo base_url()?>modelo/enviarModelo/" method="post" enctype="multipart/form-data">
			<?php if($session_idUsuario){?>
			<input type="hidden" name="nomerem" value="<?php echo $session_login?>">
			<input type="hidden" name="emailrem" value="<?php echo $session_email?>">
			<?php } ?>
			<div id="indicarForm">
				<?php if($mensagem){
					echo "<div class=\"msgOk\">$mensagem</div>";
				}
				if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } 
				if ($erro) { ?>
					<div><?php echo $erro; ?></div>
				<?php } ?>
				<label>Envie seu modelo de documento (contratos, atas, pareceres, aditivos, requerimentos etc.)</label><br /><br />
				<label style="width: 130px">Título<span style="color: red; ">*</span></label><input style="width: 220px" type="text" name="nome" value="<?php echo $row['nome']?>"><br />
				<label style="width: 130px">Selecione arquivo<span style="color: red; ">*</span></label>
				<input style="width: 230px" type="file" name="userfile" size="20"  class="campo" /><br />
				<span>Resumo</span><br>
				<textarea style="width: 360px" name="resumo"><?php echo $row['resumo']?></textarea><br/ >
				<input type="submit" value="Enviar" class="">
				<br /><br /><span style="color: red; ">* Campos obrigatórios</span>
			</div>
		</form>
		<?php
		echo"<ul class=\"listagem\">";
		if ($modelo) {
		foreach ($modelo as $row){
		?>
			<li>
					<h1><a href="<?php echo base_url()?>modelo/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></h1>
			</li>
		<?php }	
		echo"</ul>";
		}	
		?>
<?php echo "</br></br>$pag</br></br>";?>	
</div>

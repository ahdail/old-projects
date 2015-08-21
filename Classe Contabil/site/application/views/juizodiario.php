<?php
// Se o usuario estiver logado ele poder� comentar a noticia, 
// sen�o ser� redirecionado para fazer o login no sistema.
if ($session_email){
	$linkIndicacao = "javascript:indicar();";
	$linkIndicacaoTopo = "#ancoraEnviar";
} else {
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkIndicacao = base_url()."login";
	$linkIndicacaoTopo = $linkIndicacao;
}
?>
<!-- CONTE�DO -->
<div id="divConteudo">
	<?php if ($juizodiario['id']){?>
	<h1 class="titulo">Ju�zo Di�rio</h1>
	<div id="divOpcoes">
		<span id="opcoes" class="dir">
			<ul>
				<li id="imprimir"><a href="<?php echo base_url()?>imprimir/juizodiario/<?php echo $juizodiario['id']?>" target="_blank">Imprimir</a></li>
				<li id="enviar"><a href="<?php echo $linkIndicacaoTopo ?>" onclick="javascript:indicar();">Enviar por e-mail</a></li>
				<li id="tamanho">Tamanho da letra 
					<a href="javascript:ts('corpo' , -1);"><img src="<?php echo base_url()?>site/img/tamanhoAzinho.gif" title="Diminuir letra" /></a>
					<a href="javascript:ts('corpo', 1);"><img src="<?php echo base_url()?>site/img/tamanhoAzao.gif" title="Aumentar letra" /></a>
				</li>
			</ul>
		</span>
	</div>
	<h1><?php echo $juizodiario['pergunta'] ?></h1>
	<div id="corpo">
		<p align="justify" style="padding-right: 10px;"><?php echo nl2br(inserirTags($juizodiario['resposta']))?></p>
		<a class="fonte" onclick="mostrar()">Autor: Jos� Carlos Fortes</a>
	</div>
	
	<div id="autor" style="display: none; background-color: #F6F6F6; padding: 10px;">
		<p align="justify" style="font-size: 10px;">
		    <b>Jos� Carlos Fortes</b><br />
			Advogado, Contador e Matem�tico. P�s-Gradua��o em Direito Empresarial 
			(PUC-SP), em Administra��o Financeira e em Matem�tica Aplicada (UNIFOR). 
			Mestre em Administra��o de Empresas (UECE). Professor Titular do Curso de Direito (UNIFOR) e 
			Professor do Curso de Ci�ncias Cont�beis (UECE). Membro da Comiss�o de Sociedade de Advogados da Ordem dos Advogados do Brasil - OAB-CE. 
			Vice-Presidente de Fiscaliza��o do Conselho Regional de Contabilidade do Estado do Cear� - CRC-CE (1998-2001). 
			Presidente do Instituto dos Auditores Independentes do Brasil - IBRACOM - 1a.SR (2002 - 2004). Membro ad immortatitatem da Academia de Ci�ncias Cont�beis do Estado do Cear�. 
			Autor de livros nas �reas jur�dica, cont�bil e matem�tica financeira. Palestrante. Perito Cont�bil e em C�lculos Financeiros e Auditor Independente. Diretor do CIC - Centro Industrial do Cear�. 
			Presidente do Grupo Fortes de Servi�os (Inform�tica, Contabilidade, Advocacia, Avalia��o e Gest�o Patrimonial, Treinamentos e Editora).
		</p>
	</div><br>
	
	<br />
	<a name="ancoraEnviar"> </a>
		<div id="divOpcoes">
			<span id="opcoes" class="esq">
				<ul>
					<li id="imprimir"><a href="<?php echo base_url()?>imprimir/juizodiario/<?php echo $juizodiario['id']?>" target="_blank">Imprimir</a></li>
					<li id="enviar"><a href="<?php echo $linkIndicacao ?>">Enviar por e-mail</a></li>
				</ul>
			</span>
		</div>
		<!-- SCRIPT AJAX PARA INDICA��ES -->
		<script>
		$(document).ready(function() { 
			var opcoes = {
				beforeSubmit: function () {
					$("#indicarForm").html("<p>Enviando...</p>");
				},
				success: function (retorno) {
					$("#indicarForm").html(retorno);
				}
			} 
			$('#formIndicacao').ajaxForm(opcoes);
		});
		</script>

		<!-- Exibir o Formul�rio de indicacao de not�cia -->
		<form action="<?php echo base_url()?>juizodiario/indicacao/<?php echo $juizodiario['id']?>" method="post" id="formIndicacao">
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
	
	<!--  -->
	<br />
	
<!-- Listagem de todos os Ju�zos Di�rio -->	

<?php  }?>


<?php echo "</br></br>$pag</br></br>";?>	
</div>

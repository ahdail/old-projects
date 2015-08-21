<?php
// Se o usuario estiver logado ele poderá comentar a noticia, 
// senão será redirecionado para fazer o login no sistema.
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
<!-- CONTEÚDO -->
<div id="divConteudo">
	<?php if ($juizodiario['id']){?>
	<h1 class="titulo">Juízo Diário</h1>
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
		<a class="fonte" onclick="mostrar()">Autor: José Carlos Fortes</a>
	</div>
	
	<div id="autor" style="display: none; background-color: #F6F6F6; padding: 10px;">
		<p align="justify" style="font-size: 10px;">
		    <b>José Carlos Fortes</b><br />
			Advogado, Contador e Matemático. Pós-Graduação em Direito Empresarial 
			(PUC-SP), em Administração Financeira e em Matemática Aplicada (UNIFOR). 
			Mestre em Administração de Empresas (UECE). Professor Titular do Curso de Direito (UNIFOR) e 
			Professor do Curso de Ciências Contábeis (UECE). Membro da Comissão de Sociedade de Advogados da Ordem dos Advogados do Brasil - OAB-CE. 
			Vice-Presidente de Fiscalização do Conselho Regional de Contabilidade do Estado do Ceará - CRC-CE (1998-2001). 
			Presidente do Instituto dos Auditores Independentes do Brasil - IBRACOM - 1a.SR (2002 - 2004). Membro ad immortatitatem da Academia de Ciências Contábeis do Estado do Ceará. 
			Autor de livros nas áreas jurídica, contábil e matemática financeira. Palestrante. Perito Contábil e em Cálculos Financeiros e Auditor Independente. Diretor do CIC - Centro Industrial do Ceará. 
			Presidente do Grupo Fortes de Serviços (Informática, Contabilidade, Advocacia, Avaliação e Gestão Patrimonial, Treinamentos e Editora).
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
		<!-- SCRIPT AJAX PARA INDICAÇÕES -->
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

		<!-- Exibir o Formulário de indicacao de notícia -->
		<form action="<?php echo base_url()?>juizodiario/indicacao/<?php echo $juizodiario['id']?>" method="post" id="formIndicacao">
			<div id="indicarForm">
			<?php
				echo $indicacao;
			?>
			</div>
		</form>
	
	<!--  -->
	<br />
	
<!-- Listagem de todos os Juízos Diário -->	

<?php  }?>


<?php echo "</br></br>$pag</br></br>";?>	
</div>

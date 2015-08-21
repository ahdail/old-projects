<!-- COLUNA DA DIREITA -->
<div id="direita">
	<h2><a href="<?php echo base_url() ?>agenda" style="color: #000000">Agenda</a></h2>
	<div id="calendario"><iframe name="calendarioMes" src="<?php echo base_url() ?>agenda/exibirCalendario" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="145" height="144"></iframe></div>
	<div id="divEnquete">
		<h2>Enquete</h2>
			<?php if ($rowPergunta) {?>
			<p style="font-size: 10px"><b><?=$rowPergunta['pergunta']?></b></p>
			<script languague="javascript">
				function popupVotar(idResposta,idPergunta){
					if (document.getElementById('idResposta').value != "") {
					$.post('<?php echo base_url()?>votar/votar/'+idResposta+'/'+idPergunta, '', function(retorno) {
						alert('Voto computado com sucesso!');
					});
					} else {
						alert("Escolha uma das opções!");
					}
				}
				function popupResultado(idPergunta){
					window.open('<?php echo base_url()?>resultado/resultado/'+idPergunta,'Resultado','width=400,height=300,scrolling=auto,scrollbars = yes,top=400,left=400, resizable=0');
				}

				function mandaValor(valor){
					document.getElementById('idResposta').value = valor;
				}
			</script>
		<form>
			<?php 
				if ($enqueteRespostas) {
				foreach ($enqueteRespostas as $row3) { ?>
				<input type="radio" onclick="mandaValor(this.value);" name="idResposta" value="<?php echo $row3['idResposta']?>" /><font size="2"><?php echo $row3['resposta']?><br /></font>
			<?php }}?>
			<input type="hidden" id="idResposta">
			<p>
				<a href="#" style="color: #151515" onclick="popupVotar(document.getElementById('idResposta').value,<?php echo $rowPergunta['id'] ?>);">Votar</a> 
				- <a href="#" style="color: #151515" onclick="popupResultado(<?php echo $rowPergunta['id']?>);">Resultado</a>
			</p>
		</form>
		<?php } else {echo "Sem enquete";}?>
	</div>
	<h2>Newsletter</h2>
	<form action="<?php echo base_url()?>newsletter/cadastrar" method="post">
		<label class="esq" for="nome">Nome</label>
		<div id="input" class="camposNewsletter"><span><input name="nome" type="text" style="width: 90px" /></span></div>
		<label class="esq" for="email">E-mail</label>
		<div id="input" class="camposNewsletter"><span><input name="email" type="text" style="width: 90px" /></span></div>
		<label class="esq info">Informe seu nome e e-mail e receba periodicamente informações do CIC</label>
		<input class="dir" style="margin: -18px 15px" type="image" src="<?php echo base_url() ?>site/img/enviar.gif" />
	</form>
	<h2><a href="<?php echo base_url()?>faleconosco" style="color: #000000">Fale com o CIC</a></h2>
	<!-- Acredita que esse comentário basta para resolver umas quebras do iE6?! -->
</div>

<!-- BASE -->
<div id="base">
	<div id="master"></div>
	<div id="logos" align="center">
	<?php 
	if ($bannerRodape){
		foreach ($bannerRodape as $row) {
			if ($row['tipo'] == "2") {		
				//img
				$caminhoImg = base_url()."site/banners/$row[arquivo]";
				$target = ($row['novaJanela'] == "S") ? "target = _blank" : ""?>			
				<a href="<?php echo $row['url']?>" <?php echo $target ?>><img src="<?php echo $caminhoImg?>" width=<?php echo $row['largura']?> height=<?php echo $row['altura']?> border="0" /></a> 
				<?php 		
			} else {
				?>			
				<embed
					src="<?php echo $caminho ?>"
					width="<?php echo $row['largura'] ?>"
					height="<?php echo $row['altura'] ?>"
					allowscriptaccess="always"
					allowfullscreen="true" >
				</embed>
				<?php 
			}
		}
	}	
	?>
	</div>
</div>

<div style="clear: both"></div> <!-- Faz com que a formatação da GOG seja "puxada" até o fim -->
<div id="rodape">
	
</div>
<div id="topoBase" style="_border-right: 15px solid #DA251D"></div>
</div> <!-- Fim da GOG -->
<p class="peq meio" style="color: #CCCCCC">Site desenvolvido por <a href="http://www.fortesinformatica.com.br" target="_blank" style="color: #CCCCCC">Fortes Informática</a></p>
</body>
</html>

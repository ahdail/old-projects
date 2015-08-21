</div> <!--  FIM DA DIV CORPO - TOPO MENU CONTEUDO -->

<!-- LOJA -->
<div id="divLoja">
	<?php 
			if ($banner2) {
				foreach ($banner2 as $row2) {
					$caminho = base_url()."site/banners/".$row2[arquivo];
					if($row2['posicao'] == 2){
					if ($row2['tipo'] == 1) {
						echo "
							<embed
								src=$caminho
								width=195
								height=95
								allowscriptaccess=always
								allowfullscreen=true
							</embed>";		
					} else {
						$url = $row2['url'];
						if ($row2['novaJanela'] == "S"){
							$target = "target=_blank";
						} else {
							$target = "";
						}
						echo "
							<a href=".base_url()."click/contadorClick/$row2[id] $target><img src=$caminho width=195 height=95 border=\"0\"></a>
						";
					}
					} 
				}	
			} else {
				echo "<img src=".base_url()."site/img/lojaBanner.gif border=0/>";
			}
			?>
	
	<!-- LOJA > ClasseShop -->
	<img id="titulo" src="<?php echo base_url()?>site/img/lojaTitulo.gif" />
	<ul>
	<?php foreach ($loja as $rowLoja) {  ?>
		<li>
			<a href="<?php echo $rowLoja['url']?>" target="_blank">
			<img src="<?php echo base_url()?>site/banners/<?php echo $rowLoja['arquivo']?>" border="0"/>
			<p><span><?php echo $rowLoja['nome']?></span><br />
			<?php echo $rowLoja['descricao']?></p>
			</a>
		</li>
	<?php }?>	
	</ul>
		
	<!-- LOJA > Calendario -->
	<div id="divCalendario">
		<h1>Agenda de Eventos</h1>
		<iframe name="calendarioMes" src="<?php echo base_url() ?>agenda/exibirCalendario" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="145" height="144"></iframe>
		<div id="divOutras">
			<a href="<?php echo  base_url()?>eventos/divulgar">Divulgue seu Evento</a>
			<a href="<?php echo  base_url()?>agenda">Ver Eventos</a>
		</div>
	</div>
	<!-- LOJA > Enquete -->
	<div id="divEnquete">
		<h1>Enquete</h1>
				<p><b><?php echo $rowPergunta['pergunta'] ?></b></p>
			<script languague="javascript">
				function popupVotar(idResposta,idPergunta){
					if (document.getElementById('idResposta').value != "") {
						
					window.open('<?php echo base_url()?>votar/votar/'+idResposta+'/'+idPergunta,'Enquete Classe Contï¿½bil','width=400,height=300,scrolling=auto,top=0,left=0');
					} else {
						alert("Escolha uma das opï¿½ï¿½es!");
					}
				}
				function popupResultado(idPergunta){
					window.open('<?php echo base_url()?>resultado/resultado/'+idPergunta,'Resultado','width=400, height=300, scrollbars = yes,top=400,left=400, resizable=0');
				}

				function mandaValor(valor){
					document.getElementById('idResposta').value = valor;
				}
			</script>
		<form>
			
			<?php
				if ($enqueteRespostas) { 
				foreach ($enqueteRespostas as $row3) { 
				
				?>
				<input type="radio" onclick="mandaValor(this.value);" name="idResposta" value="<?php echo $row3['idResposta']?>" /><?php echo $row3['resposta']?><br /><br />
			<?php	
				
			} }?>
			<input type="hidden" id="idResposta">
			<br>
			<a href="#" onclick="popupVotar(document.getElementById('idResposta').value,<?php echo $rowPergunta['id']?>);">Votar</a> 
			- <a href="#" onclick="popupResultado(<?php echo $rowPergunta['id']?>);">Resultado</a>
		</form>
	</div>
	<!-- LOJA > Indicadores -->
	<script type="text/javascript">
	function popup(caminho) {
		path =caminho;
		var remote = null;
		remote = window.open(path,'Indicadores','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,menubar=no,width=780,height=540')
	}
	</script>
	<div id="divIndicadores">
		<h1>Indexadores</h1>
		<table id="indexadores">
			<tr>
				<td><p><?php echo $query1['nome']?></p></td>
				<td align="right"><p><?php echo $query1['valor']?></p></td>
			</tr>
			<tr>
				<td><p><?php echo $query2['nome']?></p></td>
				<td align="right"><p><?php echo $query2['valor']?></p></td>
			</tr>
			<tr>
				<td><p><?php echo $query3['nome']?></p></td>
				<td align="right"><p><?php echo $query3['valor']?></p></td>
			</tr>
			<tr>
				<td><p><?=$query4['nome']?></p></td>
				<td align="right"><p><?php echo $query4['valor']?></p></td>
			</tr>
			<tr>
				<td><p><?=$query5['nome']?></p></td>
				<td align="right"><p><?=$query5['valor']?></p></td>
			</tr>
		</table>
		<div id="divOutras">
			<a href="javascript:popup('http://www.classecontabil.com.br/indicadores/indicadores2.php')">Ver todos</a>
			<a href="http://www.fortesinformatica.com.br/v3/produtos_view.php?id=3" target="_blank">Fonte: Fortes Index</a>
		</div>
	</div>
	<!-- LOJA > Vagas -->
	<!--  <div id="divVagas">
		<h1>Vagas</h1>
		<a href="#"><b>AUX. CONTABILIDADE</b><br />
		Precisa-se com experiência comprovada.</a>
		<div id="divOutras">
			<a href="#">Outras vagas</a>
			<a href="#">Cadastrar currículo/vaga</a>
		</div>
	</div>--><br>
	<!-- LOJA > Banner -->
	<div id="divBanner">
		<?php 
		if ($banner3) {
			foreach ($banner3 as $row3) {
				$caminho = base_url()."site/banners/".$row3[arquivo];
				if ($row3['posicao'] == 3) {
					if ($row3['tipo'] == 1) {
						echo "
							<embed
								src=$caminho
								width=150
								height=165
								allowscriptaccess=always
								allowfullscreen=true
							</embed>";		
					} else {
						$url = $row3['url'];
						if ($row3['novaJanela'] == "S"){
							$target = "target=_blank";
						} else {
							$target = "";
						}
						echo "
							<a href=".base_url()."click/contadorClick/$row3[id] $target><img src=$caminho width=150 height=165 border=\"0\"></a>
						";
					}
				}
			}	
		} else {?>
			<img src="<?= base_url()?>site/img/calendarioConsultoria.gif" />
		<?php }	?>
	</div>
</div>

<div style="clear: both"></div> <!--  DIV para puxar a formatação da divGog para o corpo todo -->

</div> <!--  FIM DA DIV GERAL DA PÁGINA -->

<!-- CRÉDITOS -->
<div id="divCreditos">
	<ul>
		<li><a href="<?= base_url()?>anuncie">Anuncie</a> •</li>
		<li><a onclick="this.style.behavior='url(#default#homepage)'; this.sethomepage('<?=base_url()?>');" href="#">Fazer do Classe sua página inicial</a> •</li>
		<li><a href="#" onclick="javascript:addFav();">Adicionar a Favoritos</a> •</li>
		<li><a href="<?=base_url()?>rss">RSS</a> •</li>
		<li><a href="http://www.editorafortes.com.br/" target="_blank">ClasseShop</a> •</li>
		<li><a href="http://www.grupofortes.com.br/" target="_blank">Grupo Fortes</a> •</li>
		<li><a href="<?= base_url()?>falecom">Fale Conosco</a></li>
	</ul>
	<p>O <b>Classe Contábil</b> é o mais completo portal de informações contábeis gratuitas do país.<br />
	Conheça também as empresas do <a href="http://www.grupofortes.com.br/" target="_blank"><b>Grupo Fortes de Serviços</b></a>.</p>
	<a href="http://www.grupofortes.com.br/"><img src="<?= base_url()?>site/img/creditosLogo.gif" alt="Grupo Fortes de Serviços" /></a>
</div>
</body>
</html>
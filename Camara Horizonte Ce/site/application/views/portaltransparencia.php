<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Portal da Transparência</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
						
			
			
			<?php if($portaltransparencia['id']){?>
				
				<div class="entry">

						<h3><?php echo $portaltransparencia['titulo']?></h3>
							<?php if($portaltransparencia['doc']){?>
							<b>Arquivo disponível para baixar.</b>
							<a href="<? echo base_url()?>site/documentos/<?php echo $portaltransparencia['doc']?>" target="_blank">Clique aqui</a><br/>			
							<?php } else {?>
							<b>Arquivo não disponível.</b><br/>
							<?php } ?>
							<b>Descrição:</b><br /><?php echo nl2br($portaltransparencia['descricao'])?>
					<br clear="all" />
				<p><br /><a href="<? echo base_url()?>portaltransparencia"> todos as arquivos &raquo;</a></p>
				</div>
			
			<?php } else{ ?>
			
			<div class="entry">
				
				&#8220; O Portal da Transparência da <b>Câmara Municipal de Horizonte</b> é um meio pelo qual o cidadão pode acompanhar os gastos realizados e as receitas arrecadadas, 
				por cada unidade gestora, podendo desta forma ficar sabendo como o dinheiro público está sendo utilizado.
				Assim, qualquer pessoa pode acompanhar a execução orçamentário-financeira dos programas e das ações do governo, 
				os investimentos nas diversas áreas (saúde, educação, transporte, segurança, etc.), a situação de endividamento, as despesas com manutenção da máquina administrativa sob diversos aspectos, 
				bem como acompanhar o cumprimento dos limites estabelecidos pela Lei de Responsabilidade Fiscal.&#8221;		
				
				<p class="byline"><small>&nbsp;</small></p>
				<h2>Prestação de Contas</h2>
				
			</div>
			
				<div class="entry">
				
					<?php foreach ($portaltransparencia as $row) {?>						
							<p><b><a href="<?php echo base_url();?>portaltransparencia/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></b></p>
					<?php }
					echo $pag
					?>			
				</div>
			
			<?php }?>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>
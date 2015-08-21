<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id, numCaixa) {
		if (confirm("Deseja realmente fechar o caixa?")) {
			window.location.href="<?php echo base_url()?>pdv/caixa/fechar/"+id+"/"+numCaixa;
		}
	}
</script>
        <div id="wrapper">
            <div id="content">
		<?php //echo print_r($vendas);?>
				<div id="rightnow" style="width:100%" class="margin-left">
				<?php //if($id){?>
					
				<h3 class="reallynow">
					<span>Caixas Abertos</span><br />					
				</h3>
				
				<table>
					<thead>
						<tr>
							<th>Data da Venda</th>
							<th>Valor</th>
							<th>Nº do Caixa</th>							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($vendas as $row){?>
						<tr>
							<td align="center"><?php echo formataData($row['datahoraVenda'])?></td>
							<td align="center"><?php echo "R$ ".converteValor($row['valorTotal'])?></td>
							<td align="center"><?php echo $row['idCaixa']?></td>							
							<!--
							<td width="40px;">
								<a href="<?php echo base_url()?>pdv/caixa/abrir/<?php echo $row['idUsuario']?>"><img src="<?php echo base_url()?>site/img/icons/application_add.png" title="continuar caixa" /></a>
								<a href="#" onclick="deletar(<?php echo $row['idUsuario']?>, <?php echo $row['numCaixa']?>)"><img src="<?php echo base_url()?>site/img/admin/b_drop.png" /></a><a href="#"><img src="img/icons/page_white_delete.png" title="fechar caixa e abrir novo" /></a>
							</td>
							-->
						</tr>
					<?php } ?>
					</tbody>
					<thead >
						<tr>
							 <th>&nbsp;</th> 
							 <th width="80px">R$ <?php echo converteValor($totalGeral['valorTotal']);?><br><span style="font-size:10px">[Valor Total]</span></th> 
							 <th width="80px"><?php echo $totalCaixas;?>  <br/><span style="font-size:10px">[Qtd de <br>caixas abertos]</span></th>
						</tr>
					</thead>
					<thead >
						<tr>
							<th colspan="3"> <?php echo $pag;?></th> 
						</tr>
					</thead>
				</table>
			</div>
			
            </div>
<?php
include 'final_inc.php';

?>
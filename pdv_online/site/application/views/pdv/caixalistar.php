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
							<th width="50px">Usuario</th>
							<th width="250px">Data Abertura</th>
							<th width="250px">Data Fechamento</th>
							<th>ID Micro</th>	
							<th>Nº do Caixa</th>
							<th>Fechado</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($vendas as $row){?>
						<tr>
							<td align="center"><?php echo $row['nomeUsuario']?></td>
							<td align="center"><?php echo $row['dataAbertura']?></td>
							<td align="center"><?php echo $row['dataFechamento']?></td>
							<td align="center"><?php echo $row['IdMicro']?></td>
							<td align="center"><?php echo $row['numCaixa']?></td>
							<td align="center"><?php echo $row['fechado'] == "N" ? "Não": "Sim"?></td>																
						</tr>
					<?php } ?>
					</tbody>					
					<thead >
						<tr>
							<th colspan="6"> <?php echo $pag;?></th> 
						</tr>
					</thead>
				</table>
			</div>
			
            </div>
<?php
include 'final_inc.php';

?>
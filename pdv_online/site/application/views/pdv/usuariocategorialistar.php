<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/usuariocategoria/deletar/"+id;
		}
	}
</script>

	<div id="wrapper">
		
		<div id="content">
       			
			<div id="rightnow" style="width:100%" class="margin-left">
				<h3 class="reallynow">
					<span>Categoria dos usuário - Listagem</span><br />
					<a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuariocategoria';" style="float:left;" class="add">Nova categoria</a><br />                        
				</h3>
					
				<table>
					<thead>
						<tr>
							<th>Nome da categoria</th>
							<th>Valor (R$)</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usuariocategoria as $row) { ?>
						<tr>
							<td><?php echo $row['nomecategoria']?></td>
							<td align="center">R$ <?php echo converteValor($row['valor'])?></td>
							<td width="40px;">
								<a href="<?php echo base_url()?>pdv/usuariocategoria/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/admin/b_edit.png" /></a>
								<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/admin/b_drop.png" /></a><a href="#"><img src="img/icons/page_white_delete.png" /></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>

				</table>
					
			</div>
            
		</div>
         
<?php include 'final_inc.php';?>
<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/perfil/deletar/"+id;
		}
	}
</script>

	<div id="wrapper">
		
		<div id="content">
       			
			<div id="rightnow" style="width:100%" class="margin-left">
				<h3 class="reallynow">
					<span>Perfis de Usuario - Listagem</span><br />
					<a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/perfil/manter';" style="float:left;" class="add">Novo Perfil</a><br />                        
				</h3>
					
				<table>
					<thead>
						<tr>
							<th>Nome do perfil</th>
							<th>Sigla</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($perfil as $row) { ?>
						<tr>
							<td><?php echo $row['perfil']?></td>
							<td align="center"><?php echo $row['sigla']?></td>
							<td width="40px;">
								<a href="<?php echo base_url()?>pdv/perfil/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/admin/b_edit.png" /></a>
								<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/admin/b_drop.png" /></a><a href="#"><img src="img/icons/page_white_delete.png" /></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>

				</table>
					
			</div>
            
		</div>
         
<?php include 'final_inc.php';?>
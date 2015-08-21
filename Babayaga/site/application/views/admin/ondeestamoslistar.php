<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/ondeestamos/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Onde estamos - Listagem</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/ondeestamos/manter';" class="add">Novo Local</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>
                            	<th>Endereço</th>
								<th>Telefone</th>
								<th>Email</th>
                                <th width="40px"><a href="#">Ação</a></th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($ondeestamos as $row) {?>					
							<tr>                            	
                            	<td><?php echo $row['endereco']?></td> 
								<td><?php echo $row['telefone']?></td>
								<td><?php echo $row['email']?></td>								
                                <td>								
									<a href="<?php echo base_url()?>admin/ondeestamos/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
									<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Excluir" width="16" height="16" /></a>									
								</td>
                            </tr>
							<?}?>	
						</tbody>
					</table>
                    <div id="pager" class="a-center">
                    	<?php echo $pag;?>
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
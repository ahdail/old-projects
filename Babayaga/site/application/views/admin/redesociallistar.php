<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/redesocial/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Rede social - Listagem</h3>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Rede Social</th>
                                <th>Perfil</th>                                
                                <th width="40px">Acão</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($redesocial as $row) {?>
								<tr>									
									<td><?php echo $row['rede']?></td>
									<td><?php echo $row['link'];?></td>									
									<td>								
										<a href="<?php echo base_url()?>admin/redesocial/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
										<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Excluir" width="16" height="16" /></a>										
									</td>
								</tr>								
							<?php } ?>	
						</tbody>
					</table>
					<div id="pager" class="a-center">
							<?php echo $pag;?>
					</div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
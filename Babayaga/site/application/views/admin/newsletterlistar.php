<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/newsletter/deletar/"+id;
		}
	}
</script>


		
		<div id="content">               
				<div id="box">
                	<h3>Newsletter - Listagem</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/newsletter/manter';" class="add">Novo email</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>
                            	
                            	<th>Nome completo</th>
                                <th>Email</th>
                                
                                <th width="40px"><a href="#">Ação</a></th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($newsletter as $row) {?>					
							<tr>
                            	
                            	<td><?php echo $row['nome']?></td>
                                <td><?php echo $row['email']?></td>
                                <td>								
									<a href="<?php echo base_url()?>admin/newsletter/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
									<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a>
									
								</td>
                            </tr>
							<?}?>	
						</tbody>
					</table>
                    <div id="pager" class="a-center">
						--<?php echo $pag;?>--
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
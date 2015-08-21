<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/galeria/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Galeria - Listagem </h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/galeria/manter';" class="add">Nova galeria</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Nome da galeria</th> 
								<th>Descrição</th>     								
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($galeria as $row) {?>					
							<tr>                            	
                            	<td><?php echo $row['nomegaleria']?></td>
                                <td><?php echo $row['descricao']?></td>
                                <td>								
									<a href="<?php echo base_url()?>admin/galeria/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
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
         
<?php include 'final_inc.php';?>
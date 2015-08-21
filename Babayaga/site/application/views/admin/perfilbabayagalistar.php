<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/babayaga/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Perfil Babayaga - Listagem</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/babayaga';" style="float:left;" class="add">Adicionar Perfil Babayaga</a><p /><br/> <br/> 
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Cliente</a></th>
                                <th>Imagem</a></th>                               
                                <th width="40px">Action</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($perfilbabayaga as $row) {?>	
							<tr>
                                <td><?php echo $row['cliente']?></td>
                                <td class="a-center"><img src="<?php echo base_url()?>site/perfilbabayaga/<?php echo $row['fotoThumb']?>"></td>                                
                                <td>								
									<a href="<?php echo base_url()?>admin/babayaga/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
									<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Excluir" width="16" height="16" /></a>									
								</td>
                            </tr>
						<?php }?>
						</tbody>
					</table>
                    <div id="pager" class="a-center">
                    	<?php echo $pag;?>
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
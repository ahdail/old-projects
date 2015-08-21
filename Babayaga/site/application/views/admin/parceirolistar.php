<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/parceiro/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Parceiros - Listagem</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/parceiro';" style="float:left;" class="add">Adicionar parceiro</a><p /><br/> <br/> 
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Parceiro</th>
                                <th>Imagem</th>                                
                                <th width="40px">Acão</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($parceiro as $row) {?>	
							<tr>
                                <td><?php echo $row['nome']?></td>
                                <td class="a-center"><img src="<?php echo base_url()?>site/parceiros/<?php echo $row['fotoThumb']?>"></td>                                
                                <td>								
									<a href="<?php echo base_url()?>admin/parceiro/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
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
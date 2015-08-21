<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/noticia/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Listagem</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/noticia/manter';" style="float:left;" class="add">Nova notícia</a><p /><br/> <br/>                         
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Titulo</th>
                                <th>Exibir em</th>                                
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($noticia as $row) {?>	
							<tr>
                                <td><?php echo $row['titulo']?></td>
								<td class="a-center"><?php echo $row['exibir'] == "N" ? "Notícia": "Dica"?></td>                                
                                <td>								
									<a href="<?php echo base_url()?>admin/noticia/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
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
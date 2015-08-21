<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/usuario/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Evento - Todos os Eventos</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/evento/manter';" class="add">Novo evento</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Titulo</th>
                                <th>Data</th>
                                <th>Descrição</th>                                
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($evento as $row) {?>
								<tr>									
									<td><?php echo $row['titulo']?></td>
									<td><?php echo $novaData = sqlToDate($row['data']);?></td>
									<td><?php echo $row['descricao']?></td>
									<td>								
										<a href="<?php echo base_url()?>admin/evento/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
										<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Excluir" width="16" height="16" /></a>										
									</td>
								</tr>								
							<?php } ?>								
						</tbody>
					</table>
                    <div id="pager" class="a-center">
                    	--<?php echo $pag;?>--
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
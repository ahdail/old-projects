<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/faleconosco/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Fale Conosco - Mensagens recebidas</h3>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Nome</a></th>
                                <th>Email</th>
                                <th>Mensagem</th>                              
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($faleconosco as $row) {?>					
							<tr>                            	
                            	<td><?php echo $row['nome']?></td>
                                <td><?php echo $row['email']?></td>
								<td><?php echo $row['mensagem']?></td>
                                <td>								
									<a href="<?php echo base_url()?>admin/faleconosco/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
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
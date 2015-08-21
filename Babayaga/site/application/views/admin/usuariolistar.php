<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/usuario/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Usuário - Listagem</h3>
                	<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/usuario/manter';" style="float:left;" class="add">Novo usuário</a></p><br /><br />
					<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Nome</a></th>
                                <th>Login</th>							                   
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($usuario as $row) {?>					
							<tr>                            	
                            	<td style="font-size: 11px"><?php echo $row['nome']?></td>
								<td style="font-size: 11px"><?php echo $row['login']?></td>
                                <td>								
									<a href="<?php echo base_url()?>admin/usuario/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
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
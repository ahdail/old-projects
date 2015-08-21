<?php include 'inicio_inc.php';?>

		<div id="content">               
                	
				<div id="box">
				<h3>Quem somos</h3>
										
                	<table width="100%">
						<thead>
							<tr>
                            	
                            	<th>Descrição</th>
                                
                                <th width="50px">Ação</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($quemsomos as $row) {?>					
							<tr>
                            	<td><?php echo $row['descricao']?></td>                            	                           
                                <td width="50px">								
									<a href="<?php echo base_url()?>admin/quemsomos/detalhar/<?php echo $row['id']?>" class="add">Editar</a>									
								</td>
                            </tr>
						<?}?>	
						
						
						</tbody>
						
					</table>
                    
                </div>
                       
		</div>
         
<?php include 'final_inc.php';?>
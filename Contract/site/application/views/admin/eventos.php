<?php include 'inicio.inc.php'?>


 <!-- Main content start -->      
            <div id="content">


                
<!-- Website stats start -->               
                
<!-- Website stats end -->  
               
                <!-- Clear finsih for all floated content boxes --> <div style="clear: both"></div>



               <!-- Red Status Bar Start -->
                <?php if (validation_errors()) { ?>
                <div class="status error">                    
                    <p><span><?php echo validation_errors(); ?></span></p>
                </div>
                <?php } ?>                
                <!-- Red Status Bar End -->
                 
                
                 
                
<!-- Form elements start -->       
				<a name="form"></a>
        		<div class="container">
				
				
				<form class="" action="<?php echo base_url()?>admin/eventos/manter" enctype="multipart/form-data" method="post">
                	<div class="conthead">
                    	<h2>Cadastro de Eventos</h2>
                    </div>
					
					<?php if (!empty($atualizadoOK)){?> 
					<br />
					<div class="status info">                    
						<p><span><?php echo $atualizadoOK; ?> - <a href="#listar">Ver todos</a></span></p>
					</div>
					<?php }?> 
					
					<?php if (!empty($cadastroOK)){?> 
					<br />
					<div class="status success">                    
						<p><span><?php echo $cadastroOK; ?> - <a href="#listar">Ver todos</a></span></p>
					</div>
					<?php }?> 
					
                	<div class="contentbox">
					<p style="font-size:10px;"><strong><span style="color: red;">*</span> Campos de preenchimento obrigatório.</strong></p>
						<div class="inputboxes">
                        	<label for="dropdown">Exibir em : </label>
                           	<select name="id_secretaria">
							  <option value="0">Pagina inicial</option>									
								<?php
								
								foreach ($secretarias as $rows) { 
								if ($rows['id_secretaria'] == $eve['id_secretaria']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}
													
								?>
									<option value="<?php echo $rows['id_secretaria']?>" <?php echo $selecionado ?>><?php echo $rows['nome_secretaria']?></option>									
								<?php }?>
							</select>
                        </div>
						
                    	<div class="inputboxes">
                        	<label for="regular"><strong>Nome do Evento:</strong> <span style="color: red;">*</span></label>
                            <input type="text" size="50" id="regular" class="inputbox" name="titulo" value="<?php echo $var = empty($eve['titulo']) ? "" : $eve['titulo'] ;?>"/>
                        </div>
						
			<div class="inputboxes">
                        	<label for="regular"><strong>Data do Evento</strong> <span style="color: red;">*</span></label>
                            	<input type="text" id="data" class="inputbox" name="data" value="<?php echo $var = empty($eve['data']) ? "" : sqlToDate($eve['data']) ;?>" />
				<!--<label for="regular">&nbsp;Finalizando</label>
                            	<input type="text" id="regular" class="inputbox" />-->
                        </div>
						
			<div class="inputboxes">
                        	
                        </div>

                       <div class="inputboxes">
                        	<label for="regular">Local do Evento: </label>
                            <input type="text" size="50" id="regular" class="inputbox" name="local" value="<?php echo $var = empty($eve['local']) ? "" : $eve['local'] ;?>" />
                        </div>
                        
                        <p style="padding-top: 25px"><strong>Descrição do Evento <span style="color: red;">*</span></strong></p>
                        
                        <textarea class="text-input textarea" id="" rows="10" cols="75" name="descricao"><?php echo $var = empty($eve['descricao']) ? "" : $eve['descricao'] ;?></textarea>
                        
					<p>&nbsp;<p/>
					<input type="submit" value="Cadastrar" class="btn" /> 
					<input type="hidden" name="id" value="<?php echo $var = empty($eve['id_agenda']) ?  "" : $eve['id_agenda'];?>">
                    </div>
                </div>
                
<!-- Form elements end -->  
 
<!-- Gallery start -->   
    
 <!-- Gallery end -->
 
<!-- Generic style tabbing start -->                 
               
<!-- Generic style tabbing start -->  
                
                <!-- Clear finsih for all floated content boxes --><div style="clear: both"></div>
                

    
<!-- Table styles start --> 

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/eventos/deletar/"+id+"#listar";
		}
	}
</script> 
				<a name="listar"></a>
                <div class="container">
                	<div class="conthead">
                		<h2>Todos os Eventos</h2>
                    </div>
					
					<?php if (!empty($excluirOK)){?> 
					<br />
					<div class="status warning">                    
						<p><span><?php echo $excluirOK; ?> - <a href="#form">Novo Cadastro</a></span></p>
					</div>
					<?php }?> 
					
                	<div class="contentbox">
                        <table width="100%">
                            <thead>
                                <tr>
                                    	
                                    <th>Data do Evento</th>
                                    <th>Nome do Evento</th>
									<th>Exibir em</th>
                                    <th>Ação</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                
								<?php foreach ($eventos_todos as $row) {?>	
									<tr>
										
										<td><?php echo sqlToDate($row['data'])?></td>
										<td><?php echo $row['titulo']?></td>
										<td>
										
										<?php 
										
										if ($row['nome_secretaria'] == NULL){
											echo "Pagina Principal";
										} else {
											echo $row['nome_secretaria'];
										}
										
										?>
										
										</td>
										<td>
											<a href="<?php echo base_url()?>admin/eventos/detalhar/<?php echo $row['id_agenda']?>#form" title=""><img src="<?php echo base_url();?>images/admin/icons/icon_edit.png" title="Editar" /></a>                                       
										   <a href="#listar" onclick="deletar(<?php echo $row['id_agenda']?>)"><img src="<?php echo base_url();?>images/admin/icons/icon_delete.png" title="Excluir" /></a>
										</td>                                    
									</tr>
								<?php } ?>	
								
								
                                
                            </tbody>
                        </table>
						<!---
                        <div class="extrabottom">
                        	<ul class="pagination">
                                <li class="text">Previous</li>
                                <li class="page"><a href="#" title="">1</a></li>
                                <li><a href="#" title="">2</a></li>
                                <li><a href="#" title="">3</a></li>
                                <li><a href="#" title="">4</a></li>
                                <li class="text"><a href="#" title="">Next</a></li>
                            </ul>
                            
                        </div>
						--->
                    </div>
                </div>
<!-- Table styles end -->  
                
                
        	</div>
            
<!-- Footer start --> 
            <p id="footer">&copy; yourwebsitecompany.com</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
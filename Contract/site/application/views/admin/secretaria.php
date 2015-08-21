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
				
				
					<form class="" action="<?php echo base_url()?>admin/secretaria/manter" enctype="multipart/form-data" method="post">
                	<div class="conthead">
                    	<h2>Cadastro de Secretaria</h2>
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
                        	<label for="regular"><strong>Nome da secretaria:</strong><span style="color: red;">*</span> </label>
                            <input type="text" size="50" id="regular" class="inputbox" name="nome_secretaria" value="<?php echo $var = empty($sec['nome_secretaria']) ? "" : $sec['nome_secretaria'] ;?>"/>
                        </div>
						
						<div class="inputboxes">
                        	<label for="regular"><strong>Nome do secretário:</strong><span style="color: red;">*</span> </label>
                            <input type="text" size="70" id="regular" class="inputbox" name="nome_responsavel" value="<?php echo $var = empty($sec['nome_responsavel']) ? "" : $sec['nome_responsavel'] ;?>"/>
                        </div>
						
						<div class="inputboxes">
                        	<label for="regular"><strong>Email:</strong><span style="color: red;">*</span></label>
                            <input type="text" id="regular" class="inputbox" name="email" value="<?php echo $var = empty($sec['email']) ? "" : $sec['email'] ;?>"/>
                        </div>
						
						<div class="inputboxes">
                        	<label for="regular"><strong>Telefone:</strong><span style="color: red;">*</span></label>
                            <input type="text" id="regular" class="inputbox" name="telefone" value="<?php echo $var = empty($sec['telefone']) ? "" : $sec['telefone'] ;?>"/>
                        </div>

                       <div class="inputboxes">
                        	<label><strong>Foto</strong> [ Formato - .jpg ou .gif]</label>
                            	<input name="userfile" type="file" size="50"  />
				<br /><strong><font size="2" color="blue">Tamanho máximo do arquivo  é 100px x 115px</font></strong>
				<?php if (!empty($sec['imagem_responsavel_thumb'])){?> 
					<p><img src="<? echo base_url()?>uploads/pasta_sec/<?php echo $sec['imagem_responsavel_thumb']?>" /><br />
					<font size=1px>[Imagem Atual]</font></p>
				<?php }?>
                        </div>

                        <p style="padding-top: 25px"><strong>Descrição da secretaria <span style="color: red;">*</span></strong></p>
                        
                        <textarea class="text-input textarea" id="" rows="10" cols="75" name="descricao_responsavel"><?php echo $var = empty($sec['descricao_responsavel']) ? "" : $sec['descricao_responsavel'] ;?></textarea>
                        
                        <p>&nbsp;</p>
						<input type="submit" value="Cadastrar" class="btn" /> 
						<input type="hidden" name="id" value="<?php echo $var = empty($sec['id_secretaria']) ?  "" : $sec['id_secretaria'];?>">
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
			window.location.href="<?php echo base_url()?>admin/secretaria/deletar/"+id+"#listar";
		}
	}
</script> 
				<a name="listar"></a>
                <div class="container">
                	<div class="conthead">
                		<h2>Todas as Secretarias</h2>
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
                                    <th>Foto</th>
                                    <th>Nome do Responsável</th>
                                    <th>Nome da Secretaria</th>                                    
				    <th>E-mail</th>
                                    <th>Telefone</th>                                    
				    <th>Ação</th>                                    
                                </tr>
                            </thead>
                            <tbody>
				<?php foreach ($secretarias as $row) {?>
                                <tr>
                                	<td>
                                	
	                                	<?php if (!empty($row['imagem_responsavel_thumb'])){?> 
							<p><img src="<? echo base_url()?>uploads/pasta_sec/<?php echo $row['imagem_responsavel_thumb']?>" /><br />							
						<?php } else {?>
							<font size=1px>[Imagem não cadastrada!]</font></p>
						<?php } ?>                                	
                                	</td>
                                    	<td><?php echo $row['nome_responsavel']?></td>
                                    	<td><?php echo $row['nome_secretaria']?></td>					
					<td><?php echo $row['email']?></td>
					<td><?php echo $row['telefone']?></td>
                                    <td>
                                        <a href="<?php echo base_url()?>admin/secretaria/detalhar/<?php echo $row['id_secretaria']?>#form"" title=""><img src="<?php echo base_url();?>images/admin/icons/icon_edit.png" title="Editar" /></a>                                       
					<a href="#listar" onclick="deletar(<?php echo $row['id_secretaria']?>)"><img src="<?php echo base_url();?>images/admin/icons/icon_delete.png" title="Excluir" /></a>
                                    </td>                                    
                                </tr>
				<?php } ?>	
																
                            </tbody>
                        </table>
						<!--
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
						-->
                    </div>
                </div>
<!-- Table styles end -->  
                
                
        	</div>
            
<!-- Footer start --> 
            <p id="footer">&copy; ahdail.net</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
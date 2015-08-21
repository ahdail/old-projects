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
                
                 
                
<!-- Form elements start -->     
  
			<a name="form"></a>
				
        		<div class="container">
				
			
			<?php if (!empty($NovaOK)){	?>
			<form class="" name="form1" action="<?php echo base_url()?>admin/fotos/manter" enctype="multipart/form-data"  method="post">
			
			<?php } else {	?>
			<form class="" name="form1" action="<?php echo base_url()?>admin/fotos/pesquisar#form" method="post">
			<?php } ?>
				
                	<div class="conthead">
                    	<h2>Cadastrar Fotos</h2>
                    </div>
					
					
                	<div class="contentbox">
				<p style="font-size:10px;"><strong><span style="color: red;">*</span> Campos de preenchimento obrigatório.</strong></p>
						<div class="inputboxes">
						
				<?php if (empty($NovaOK)){?>
				<p><strong>Caso deseje visualizar todas as fotos cadastradas, selecione um álbum.</strong></p>		
				<?php }?>
				
                        	<label for="dropdown"><strong>Álbum:</strong><span style="color: red;">*</span></label>
                           	<select name="id_album" id="dropdown">
							<option value="">Selecione...</option >
							
							<?php
								foreach ($album_todos as $fots) { 
								if ($fots['id_album'] == $fot['id_album'] || $fots['id_album'] == $fot[0]['id_album'] ){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}				
							?>

								<option value="<?php echo $fots['id_album']?>" <?php echo $selecionado ?>><?php echo $fots['titulo']?></option>
                            
							<?php } ?>
                            </select>
							
							 <?php if (empty($NovaOK)){	?>
							&nbsp;<input type="submit" value="Pesquisar..." class="btn" /> 
							 <?php } 	?>
							
                        </div>
												
                        <?php if (!empty($NovaOK)){	?>
						<div class="inputboxes">
                        	<label>Foto 1 [ Formato - .jpg ou gif]</label>
                            <input name="userfile" type="file" size="50"  />
							<br /><strong><font size="2" color="blue">Tamanho máximo do arquivo  é 1000 X 600 e 1MB</font></strong>
							<?php if (!empty($fot['foto_thumb'])){?> 
								<p><img src="<? echo base_url()?>uploads/pasta_fot/<?php echo $fot['foto_thumb']?>" /><br />
								<font size=1px>[Imagem Atual]</font></p>
							<?php }?>
                        </div>
						<?php } ?>
						
                        
					<p></p>	
					<?php if (!empty($NovaOK)){	?>
					<input type="submit" value="Cadastrar" class="btn" /> 
					<input type="hidden" name="id" value="<?php echo $var = empty($fot['id_foto']) ?  "" : $fot['id_foto'];?>">
					
					
					
					<?php } ?>
                    </div>
					</form>
					
					
					<?php if (!empty($NovaOK)){	?>
					
					<div class="status warning">                    
						<p><span><a href="<?php echo base_url()?>admin/pagina/galeria">Todas as fotos <img src="<?php echo base_url()?>images/admin/list.png"></a></span></p>
					</div>	
					
					<?php } else { ?>
					
					<div class="status warning">                    
						<p><span>
						<a href="<?php echo base_url()?>admin/fotos/nova#form">
						<strong>Nova foto, clique aqui!</strong> <img src="<?php echo base_url()?>images/admin/new.png">
						</a></span></p>
					</div>
					
					<?php }  ?>
					
					
					
                </div>
                
<!-- Form elements end -->  
 
<!-- Gallery start -->   
			
			
				
 <!-- Gallery end -->
 
<!-- Generic style tabbing start -->                 
               
<!-- Generic style tabbing start -->  
                
                <!-- Clear finsih for all floated content boxes --><div style="clear: both"></div>
                

    
<!-- Table styles start --> 

<script language="javascript">
	function deletar(id_foto, id_album) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/fotos/deletar/"+id_foto+"/"+id_album+"#listar";
		}
	}
</script> 



		<a name="listar"></a>
        	<div class="container" style="display:<?php echo $display; ?>">
                	<div class="conthead">
                		<h2>Todas as Fotos</h2>
                        </div>

			
			<?php if (!empty($atualizadoOK)){?> 
			<br />
			<div class="status info">                    
				<p><span><?php echo $atualizadoOK; ?><!-- - <a href="#listar">Ver todos</a>--></span></p>
			</div>
			<?php }?> 
			
			<?php if (!empty($cadastroOK)){?> 
			<br />
			<div class="status success">                    
				<p><span><?php echo $cadastroOK; ?><!-- - <a href="#listar">Ver todos</a>--></span></p>
			</div>
			<?php }?>
			
			<?php if (!empty($excluirOK)){?> 
			<br />
			<div class="status info">                    
				<p><span><?php echo $excluirOK; ?><!-- - <a href="<?php echo base_url()?>admin/fotos/nova#form">Cadastrar nova foto <img src="<?php echo base_url()?>images/admin/new.png"></a>---></span></p>
			</div>
			<?php }?>  
			
			<?php 
			//echo $fotos_todas[0]['id_album'];
			//echo $display;
			
			if(!empty($fotos_todas[0]['id_album'])){ ?>
				
				<div class="contentbox">
	                        <table width="100%">
	                            <!--
	                            <thead>
	                                <tr>
	                                    <th>Foto </th>
	                                    <th>Nome do Álbum</th>									
	                                    <th>Ação</th>                                    
	                                </tr>
	                            </thead>
	                            -->
	                            <tbody>
					<?php foreach ($fotos_todas as $row) {?>
	                                
	                                
	                                <tr>
	                                    <a href="<?php echo base_url()?>admin/fotos/detalhar/<?php echo $row['id_foto']?>#form" title="<?php echo $row['titulo_album']?>">
	                                    	
	                                    	<img src="<? echo base_url()?>uploads/pasta_fot/<?php echo $row['foto_thumb']?>" />
	                                    </a>                                    
	                                </tr>
	                                
	                                <tr>
	                                    <a href="<?php echo base_url()?>admin/fotos/detalhar/<?php echo $row['id_foto']?>#form" title="">
	                                    	<img src="<?php echo base_url();?>images/admin/icons/icon_edit.png" title="Editar" />
	                                    </a>                                       
	                                      <a href="#listar" onclick="deletar(<?php echo $row['id_foto']?>)"><img src="<?php echo base_url();?>images/admin/icons/icon_delete.png" title="Delete" /></a>                               
	                                </tr>
	                                
	                                
	                                
	                                
	                                
	                                
	                                
	                                
	                                
					 <?php } ?>
	                            </tbody>
	                        </table>
                    		</div>
                    	<?php } ?>
                    	
                </div>
			
			
			
					

                
        </div>
		

<!-- Table styles end -->           
<!-- Footer start --> 
            
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
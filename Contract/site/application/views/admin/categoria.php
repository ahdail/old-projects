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
        	<div class="container" id="container">
				
				
				
			<form id="formNoticia" class="" action="<?php echo base_url()?>admin/categoria/manter" enctype="multipart/form-data" method="post">
				
                	<div class="conthead">
                    	<h2>Categoria</h2>
                    </div>
					
					
					<?php if (!empty($atualizadoOK)){?> 
					<br />
					<div class="status info">                    
						<p><span><?php echo $atualizadoOK; ?></span></p>
					</div>
					<?php }?> 
					
					<?php if (!empty($cadastroOK)){?> 
					<br />
					<div class="status success">                    
						<p><span><?php echo $cadastroOK; ?></span></p>
					</div>
					<?php }?> 
					
					
                	<div class="contentbox">
				<p style="font-size:10px;"><strong><span style="color: red;">*</span> Campos de preenchimento obrigatório.</strong></p>	
					
							

                    	<div class="inputboxes">
                        	<label for="regular" ><strong>Nome da Categoria:</strong><span style="color: red;">*</span> </label>
                            <input type="text" size="70" id="nome_categoria" class="inputbox" name="nome_categoria" value="<?php echo $var = empty($cat['nome_categoria']) ? "" : $cat['nome_categoria'] ;?>" />
                        </div>

                        <div class="inputboxes">
                        	<label>Imagem [ Formato - .jpg ou .gif ]</label>
                            <input name="userfile" type="file" size="50"  />
							<br /><strong><font size="2" color="blue">Tamanho máximo do arquivo  é 1MB</font></strong>
							<?php if (!empty($cat['imagem'])){?> 
								<p><img src="<? echo base_url()?>uploads/pasta_cat/<?php echo $cat['imagem_thumb']?>" /><br />
								<font size=1px>[Imagem Atual]</font></p>
							<?php }?>
                        </div>
                        
                        <p style="padding-top: 25px"><strong>Descricão<span style="color: red;">*</span></strong></p>
                        
                        <textarea class="text-input textarea" id="" name="descricao" rows="5" cols="75"><?php echo $var = empty($cat['descricao']) ? "" : $cat['descricao'] ;?></textarea>
                        
                      <br/><br/><br/>
                        
                        
                        
						

						 
                        
                	<input type="submit" value="Cadastrar" class="btn" />
                	
                	<input type="hidden" name="id" value="<?php echo $var = empty($cat['id_categoria']) ?  "" : $cat['id_categoria'];?>">
			   
                	
                	
         		
			
			
                	 
                    </div>
                    </form>
                </div>
                
<!-- Form elements end -->  
 
<!-- Gallery start -->   
    
 <!-- Gallery end -->
 
<!-- Generic style tabbing start -->                 
               
<!-- Generic style tabbing start -->  
                
                <!-- Clear finsih for all floated content boxes --><div style="clear: both"></div>
                

    
<!-- Table styles start -->  


				

                
            
<!-- Footer start --> 
            <p id="footer">&copy; ahdail.net</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
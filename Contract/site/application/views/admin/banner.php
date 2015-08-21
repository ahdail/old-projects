<?php include 'inicio.inc.php'?>


 <!-- Main content start -->      
            <div id="content">


                
<!-- Website stats start -->               
                
<!-- Website stats end -->  
               
                <!-- Clear finsih for all floated content boxes --> <div style="clear: both"></div>



                
                 <!-- Red Status Bar Start -->
                <?php 
                
                //$msgOK = "";
                if (false){?> 
                <div class="status success">                    
                    <p><span><?php echo $msgOK; ?></span></p>
                </div>
                <?php }?> 
                <!-- Red Status Bar End -->
                
                <!-- Green Status Bar Start -->
                <?php if (validation_errors()) { ?>
                <div class="status error">
                    
                    <p><span><?php echo validation_errors(); ?></span></p>
                </div>
                <?php } ?>
                <!-- Green Status Bar End -->
                
                 
                
<!-- Form elements start -->       
				<a name="form"></a>
        		<div class="container">
				
					<form class="" action="<?php echo base_url()?>admin/banner/manter" enctype="multipart/form-data" method="post">
				
                	<div class="conthead">
                    	<h2>Cadastrar Banner</h2>
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
                        	<label for="regular"><strong>Nome do banner:</strong><span style="color: red;">*</span></label>
                            <input type="text" size="50" id="regular" class="inputbox" name="titulo" value="<?php echo $var = empty($ban['titulo']) ? "" : $ban['titulo'] ;?>" />
                        </div>
						
				

                         <div class="inputboxes">
                        	<label>Banner [ Formato - .jpg ou gif]</label>
                            <input name="userfile" type="file" size="50"  />
							<br /><strong><font size="2" color="blue">Tamanho da imagem é 560px x 300px</font></strong>
							<?php if (!empty($ban['imagem_thumb'])){?> 
								<p><img src="<? echo base_url()?>banners/<?php echo $ban['imagem_thumb']?>" /><br />
								<font size=1px>[Imagem Atual]</font></p>
							<?php }?>
                        </div>
                         <div class="inputboxes">
                        	<label for="chkbox1">Exibir banner?: </label>
                        	
                        	<input type="radio" name="exibir" id="radio_1" class="checkbox" value="S" <?php echo $var = empty($ban['exibir']) || $ban['exibir'] == "S" ? "checked": ""?> /> Sim &nbsp;
                        	<input type="radio" name="exibir" id="radio_1" class="checkbox" value="N" <?php echo $var = empty($ban['exibir']) || $ban['exibir'] == "N" ? "checked": ""?> /> Não
                        	
                           	
                        </div>
                        
                        
					<p>&nbsp;<p/>
					<input type="submit" value="Cadastrar" class="btn" />
					<input type="hidden" name="id" value="<?php echo $var = empty($ban['id_banner']) ?  "" : $ban['id_banner'];?>">					
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
			window.location.href="<?php echo base_url()?>admin/banner/deletar/"+id+"#listar";
		}
	}
</script> 
				<a name="listar"></a>
                <div class="container">
                	<div class="conthead">
                		<h2>Todos os Banners</h2>
                    </div>
					
					<?php if (!empty($excluirOK)){?> 
					<br />
					<div class="status warning">                    
						<p><span><?php echo $excluirOK; ?> - <a href="#form">Novo Cadastro</a></span></p>
					</div>
					<?php }?> 
					
                	<div class="contentbox">
                        <table width="100%">
                           <!--
                            <thead>
                                <tr>
                                    <th>Banner</th>
                                    <th>Nome do Álbum</th>				    
                                    <th>Ação</th>                                    
                                </tr>
                            </thead>
                            -->
                            <tbody>
                                <?php foreach ($banner_todos as $row) {?>	
                                
                                <tr>
                                    <a href="<?php echo base_url()?>admin/banner/detalhar/<?php echo $row['id_banner']?>#form" title="<?php echo $row['titulo']?>">
                                    	
                                    	<img src="<? echo base_url()?>banners/<?php echo $row['imagem_thumb']?>" />
                                    </a>                                    
                                </tr>
                                
                                <tr>
                                    <a href="<?php echo base_url()?>admin/banner/detalhar/<?php echo $row['id_banner']?>#form" title="">
                                    	<img src="<?php echo base_url();?>images/admin/icons/icon_edit.png" title="Editar" />
                                    </a>                                       
                                      <a href="#listar" onclick="deletar(<?php echo $row['id_banner']?>)"><img src="<?php echo base_url();?>images/admin/icons/icon_delete.png" title="Delete" /></a>                               
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
            <p id="footer">&copy; yourwebsitecompany.com</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
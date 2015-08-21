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
				
					<form class="" id="formInstitucional" action="<?php echo base_url()?>admin/institucional/manter" enctype="multipart/form-data" method="post">
				
                	<div class="conthead">
                    	<h2>Institucional</h2>
                    </div>
					
					<?php if (!empty($atualizadoOK)){?> 
					<br />
					<div class="status info">                    
						<p><span><?php echo $atualizadoOK; ?></span></p>
					</div>
					<?php }?> 
					
					
                	<div class="contentbox">
						<p style="font-size:10px;"><strong><span style="color: red;">*</span> Campos de preenchimento obrigatório.</strong></p>
						<!--
						<div class="inputboxes">
                        	<label for="regular"><strong>Nome do Vídeo:</strong><span style="color: red;">*</span> </label>
                            	<input type="text" size="50" id="regular" class="inputbox" name="titulo" value="<?php echo $var = empty($video['titulo']) ? "" : $video['titulo'] ;?>" />
                        </div>
						
			
						<div class="inputboxes">
								<label>Capa Álbum [Formato - jpg ou gif]</label>
									<input name="userfile" type="file" size="50"  />
						<br /><strong><font size="2" color="blue">Tamanho máximo do arquivo  é 120px x 70px</font></strong>
						
						<?php if (!empty($video['capa_video_thumb'])){?> 
							<p><img src="<? echo base_url()?>uploads/pasta_vid/<?php echo $video['capa_video_thumb']?>" /><br />
							<font size=1px>[Imagem Atual]</font></p>
						<?php }?>
                        </div>
						--->
                        <p style="padding-top: 25px"><strong>Missão</strong><span style="color: red;">*</span></p>
                        <textarea class="text-input textarea" id="missao" rows="6" cols="100" name="missao"><?php echo $var = empty($institucional['missao']) ? "" : $institucional['missao'] ;?></textarea>
						
						<p style="padding-top: 25px"><strong>Valores</strong><span style="color: red;">*</span></p>                     
                        <textarea class="text-input textarea" id="valores" name="valores" id="" rows="6" cols="100" ><?php echo $var = empty($institucional['valores']) ? "" : $institucional['valores'] ;?></textarea>
						
						<p style="padding-top: 25px"><strong>Quem Somos</strong><span style="color: red;">*</span></p>                     
                        <textarea class="text-input textarea" id="quem_somos" name="quem_somos" id="" rows="6" cols="100" ><?php echo $var = empty($institucional['quem_somos']) ? "" : $institucional['quem_somos'] ;?></textarea>
						
						<p style="padding-top: 25px"><strong>Diferenciais</strong><span style="color: red;">*</span></p>                     
                        <textarea class="text-input textarea" id="diferenciais" name="diferenciais" id="" rows="6" cols="100" ><?php echo $var = empty($institucional['diferenciais']) ? "" : $institucional['diferenciais'] ;?></textarea>

					<p>&nbsp;<p/>
					<input type="submit" value="Cadastrar" class="btn" /> 
					<input type="hidden" name="id" value="<?php echo $var = empty($institucional['id_institucional']) ?  "" : $institucional['id_institucional'];?>">
                    </div>
                </div>
                
<!-- Form elements end -->  
 
<!-- Gallery start -->   
    
 <!-- Gallery end -->
 
<!-- Generic style tabbing start -->                 
               
<!-- Generic style tabbing start -->  
                
                <!-- Clear finsih for all floated content boxes --><div style="clear: both"></div>
                

    
<!-- Table styles start -->  



  
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
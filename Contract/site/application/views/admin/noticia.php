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
				
				
				
			<form id="formNoticia" class="" action="<?php echo base_url()?>admin/noticia/manter" enctype="multipart/form-data" method="post">
				
                	<div class="conthead">
                    	<h2>Cadastro de Notícias</h2>
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
							<label for="dropdown"><strong>Categoria</strong><span style="color: red;">*</span></label>
							<select name="id_categoria">
							<option value="">Selecione...</option >
							
							<?php
							
								print_r($categorias);
								foreach ($categorias as $cat) { 
								if ($cat['id_categoria'] == $not['id_categoria'] || $cat['id_categoria'] == $not[0]['id_categoria'] ){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}				
							?>

								<option value="<?php echo $cat['id_categoria']?>" <?php echo $selecionado ?>><?php echo $cat['nome_categoria']?></option>
                            
							<?php } ?>
                            </select>
							
							</div>

                    	<div class="inputboxes">
                        	<label for="regular" ><strong>Titulo da Notícia:</strong><span style="color: red;">*</span> </label>
                            <input type="text" size="70" id="titulo" class="inputbox" name="titulo" value="<?php echo $var = empty($not['titulo']) ? "" : $not['titulo'] ;?>" />
                        </div>
						
						<div class="inputboxes">
                        	<label for="regular"><strong>Data da Publicação:</strong><span style="color: red;">*</span></label>
                            <input type="text" id="data" class="inputbox" name="data" value="<?php echo $var = empty($not['data']) ? "" : sqlToDate($not['data']) ;?>" />
                        </div>

                        <div class="inputboxes">
                        	<label>Imagem [ Formato - .jpg ou .gif ]</label>
                            <input name="userfile" type="file" size="50"  />
							<br /><strong><font size="2" color="blue">Tamanho máximo do arquivo  é 1MB</font></strong>
							<?php if (!empty($not['imagem'])){?> 
								<p><img src="<? echo base_url()?>uploads/pasta_not/<?php echo $not['imagem_thumb']?>" /><br />
								<font size=1px>[Imagem Atual]</font></p>
							<?php }?>
                        </div>
                        
                        <p style="padding-top: 25px"><strong>Resumo da Notícia<span style="color: red;">*</span></strong></p>
                        
                        <textarea class="text-input textarea" id="" name="resumo" rows="5" cols="75"><?php echo $var = empty($not['resumo']) ? "" : $not['resumo'] ;?></textarea>
                        
                        <p style="padding-top: 25px"><strong>Conteúdo da Notícia</strong></p>
                        
                        <textarea class="text-input textarea" id="" name="conteudo" rows="10" cols="150"><?php echo $var = empty($not['conteudo']) ? "" : $not['conteudo'] ;?></textarea>
                        
						<div class="inputboxes">
                        	<label for="regular"><strong>Fonte da notícia:</strong><span style="color: red;">*</span> </label>
                            <input type="text" size="50"  id="regular" class="inputbox" name="fonte" value="<?php echo $var = empty($not['fonte']) ? "" : $not['fonte'] ;?>" />
                        </div>

						 <div class="inputboxes">
                        	<label for="chkbox1">Destaque na pagina inicial?: </label>
                        	
                        	<input type="radio" name="destaque" id="radio_1" class="checkbox" value="S" <?php echo $var = empty($not['destaque']) || $not['destaque'] == "S" ? "checked": ""?> /> Sim &nbsp;
                        	<input type="radio" name="destaque" id="radio_1" class="checkbox" value="N" <?php echo $var = empty($not['destaque']) || $not['destaque'] == "N" ? "checked": ""?> /> Não
                        	
                           	
                        </div>
                        
                	<input type="submit" value="Cadastrar" class="btn" />
                	
                	<input type="hidden" name="id" value="<?php echo $var = empty($not['id_noticia']) ?  "" : $not['id_noticia'];?>">
			   
                	
                	
         		
			
			
                	 
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

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/noticia/deletar/"+id+"#listar";
		}
	}
</script> 
				
				
 
				<a name="listar"></a>
                <div class="container">				
                	<div class="conthead">
                		<h2>Todas as notícias</h2>
                    </div>	
					<!-- Green Status Bar Start -->
					<?php if (!empty($excluirOK)){?> 
					<br />
					<div class="status warning">                    
						<p><span><?php echo $excluirOK; ?> - <a href="#form">Novo Cadastro</a></span></p>
					</div>
					<?php }?> 
					
					

					<!-- Green Status Bar End -->					
                	
                       <table cellpadding="0" cellspacing="0" border="0" class="display" id="id_table_noticia">
                            <thead>
                                <tr>
                                    <th>Data da publicação</th>
                                    <th>Titulo</th>
									<th>Exibir em</th>
                                    <th>Ação</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                            
                              <?php foreach ($noticias_todas as $not) {?>	
                                <tr>
                                    <td><?php echo sqlToDate($not['data'])?></td>
                                    <td><?php echo $not['titulo']?></td>
									<td>
										<?php 										
									if ($not['nome_categoria'] == NULL){
										echo "Pagina Principal";
									} else {
										echo $not['nome_categoria'];
									}					
									?>
									</td>
                                    <td>
                                       <a href="<?php echo base_url()?>admin/noticia/detalhar/<?php echo $not['id_noticia']?>#form" title=""><img src="<?php echo base_url();?>images/admin/icons/icon_edit.png" alt="Edit" /></a>                                       
                                       <a href="#listar" onclick="deletar(<?php echo $not['id_noticia']?>)"><img src="<?php echo base_url();?>images/admin/icons/icon_delete.png" alt="Delete" /></a>
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
                
<!-- Table styles end -->  
                
                
        	</div>
            
<!-- Footer start --> 
            <p id="footer">&copy; ahdail.net</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 


<?php //include 'final.inc.php'?>
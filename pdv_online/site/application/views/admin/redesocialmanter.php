<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Rede social - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/redesocial/listar';" style="float:left;" class="add">Todas as redes</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">
							<legend>Selecione o perfil</legend>
										
							<select name="idPerfil">	
								<option >selecione</option>	
								<option >Orkut</option>	
								<option >Facebook</option>								
								<option >Twitter</option>
							</select><input name="site" id="site" type="text" value=""  />
							<br />
							
							<select name="idPerfil">
								<option >selecione</option>								
								<option >Orkut</option>	
								<option >Facebook</option>								
								<option >Twitter</option>
							</select><input name="site" id="site" type="text" value=""  />
							<br />
									
							<select name="idPerfil">
								<option >selecione</option>	
								<option >Orkut</option>	
								<option >Facebook</option>								
								<option >Twitter</option>
							</select><input name="site" id="site" type="text" value=""  />
							<br />
						</fieldset>
                      
						<div align="center">
							<input id="button1" type="submit" value="cadastrar" /> 
							<input type="hidden" name="id" value="<?php echo $row['id']?>">
						</div>
				  
                    </form>
					
				</div>

            </div>
			
<?php include 'final_inc.php';?>
<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Parceiros - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/parceiro/listar';" style="float:left;" class="add">Todas os parceiros</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nomeparceiro">Nome do parceiro<small style="color:red;">*</small> </label> 
							<input name="nomeparceiro" id="nomeparceiro" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="foto">Foto<small style="color:red;">*</small></label> 
							<input name="foto" id="fonte" type="file" value=""  />
							<br />
							<label for="login">Descrição<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:150px;"></textarea>
							<br /><br />							
							<label for="site">Site (http://...) </label> 
							<input name="site" id="site" type="text" value="" />
																		
							
						</fieldset>
                      
						<div align="center">
							<input id="button1" type="submit" value="cadastrar" /> 
							<input type="hidden" name="id" value="<?php echo $row['id']?>">
						</div>
				  
                    </form>
					
				</div>

            </div>
			
<?php include 'final_inc.php';?>
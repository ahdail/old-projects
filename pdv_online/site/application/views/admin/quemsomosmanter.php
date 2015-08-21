<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Quem somos - Cadastro</span><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							<legend>Quem somos</legend>
							
							<label for="login">Descrição<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:100px;"></textarea>
							<br />
							<label for="login">Missão<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:100px;"></textarea>
							<br />
							<label for="login">Valores<small style="color:red;">*</small> </label> 
							<textarea style="width:700px;height:100px;"></textarea>
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
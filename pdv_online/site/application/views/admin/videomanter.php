<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Vídeo - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario/listar';" style="float:left;" class="add">Todas as notícias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="titulo">Título do vídeo<small style="color:red;">*</small> </label> 
							<input name="titulo" id="titulo" style="width:400px" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="login">Breve descrição<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:100px;"></textarea>
							<br />
							<label for="login" style="width:500px">Código(script)<small style="color:red;">*</small><i> (copie [ctrl+c] e cole[ctrl+v] o código é gerado pelo youtube)</i></label> 
							<textarea style="width:700px; height:50px;"></textarea>
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
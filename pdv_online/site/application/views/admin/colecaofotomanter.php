<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Fotos da Coleção - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario/listar';" style="float:left;" class="add">Todas as fotos da coleções</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							<legend>Fotos da Coleção</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nomecolecao" >Nome da Coleção<small style="color:red;">*</small> </label> 												
							<select name="idPerfil">							
								<option >Pimavera 2010</option>	
								<option >Verão 2011</option>								
								<option >Outuno/Inverno 2011</option>								
							</select>
							<br />
							<label for="descricao">Foto<small style="color:red;">*</small> </label> 
							<input id="button1" type="file" /> 
							<br />
							
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
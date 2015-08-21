<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Evento - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario/listar';" style="float:left;" class="add">Todas as notícias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nome">Nome do evento<small style="color:red;">*</small> </label> 
							<input name="nome" id="nome" style="width:400px" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="dataini">Data Inicial<small style="color:red;">*</small></label> 
							<input name="dataini" id="periodo1" type="text" value="<?php echo $row['dataini']?>"  />
							<br />
							<label for="datafim">Data Final<small style="color:red;">*</small></label> 
							<input name="datafim" id="periodo2" type="text" value="<?php echo $row['datafim']?>"  />
							<br />
							<label for="login">Descrição<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:150px;"></textarea>
							
							<br /><br />
							<label for="site">Site (http://...) </label> 
							<input name="site" style="width:400px" id="site" type="text" value=""  />
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
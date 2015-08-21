<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Notícia - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario/listar';" style="float:left;" class="add">Todas as notícias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							<legend>Notícia</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="titulo">Título<small style="color:red;">*</small> </label> 
							<input name="titulo" id="titulo" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="login">Descrição<small style="color:red;">*</small> </label> 
							<textarea></textarea>
							<br />
							<label for="fonte">Fonte<small style="color:red;">*</small></label> 
							<input name="fonte" id="fonte" type="text" value=""  />&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							<br />
							<label for="site">Site (http://...) </label> 
							<input name="site" id="site" type="text" value=""  />
							<br />												
							<label for="idPerfil">Perfil<small style="color:red;">*</small> </label>							
							<select name="idPerfil">							
								<option >Pag. Inicial</option>	
								<option >Blog</option>								
							</select>
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
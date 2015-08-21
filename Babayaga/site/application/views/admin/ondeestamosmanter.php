<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Onde estamos</span><br /> 
						<a href="#" onclick="window.location.href='<?php echo base_url()?>admin/ondeestamos/listar';" style="float:left;" class="add">Todos os locais</a><br />                        						
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/ondeestamos/manter" method="post">

						<fieldset id="personal">

							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="endereco" >Endereço<small style="color:red;">*</small> </label> 
							<input name="endereco" id="endereco" style="width:400px" type="text" value="<?php echo $row['endereco']?>"/><br />
						
							<label for="telefone" >Telefone<small style="color:red;">*</small> </label> 
							<input name="telefone" id="telefone" style="width:200px" type="text" value="<?php echo $row['telefone']?>" /><br />
						
							<label for="email" >E-mail<small style="color:red;">*</small> </label> 
							<input name="email" id="email" style="width:300px" type="email" value="<?php echo $row['email']?>" /><br />
							<br />
							<fieldset id="personal">
							
							<small style="color:red;">*</small><b>Os email's devem ser separado por " ; " ex: <i>email1@saite.com ; email2@saite.com ; ...</i> </b><br />
							<label for="outroemail" >Outros e-mail's<small style="color:red;">*</small> </label>
							<input name="outroemail" id="outroemail" style="width:650px" type="email" value="<?php echo $row['outroemail']?>" /><br />
							</fieldset >
							<br />
						</fieldset>
					
						<fieldset id="personal">

							<legend>Google maps</legend>
							
							<label for="localizacao" style="width:400px">Insira o código gerado pelo google maps<small style="color:red;">*</small> </label> 
							<textarea name="localizacao" style="width:700px; height:100px;"><?php echo $row['localizacao']?></textarea>
							<br />
							
						</fieldset>
                      
						<div align="center">
							<input id="button1" type="submit" value="cadastrar" /> 
							<input type="hidden" name="id" value="<?php echo $row['id']?>">
							<?php if($row['id']){?>
							<input type="hidden" name="acao" value="edit">
							<?php } else {?>
							<input type="hidden" name="acao" value="add">
							<?php }?>								
						</div>
				  
                    </form>
					
				</div>

            </div>
			
<?php include 'final_inc.php';?>
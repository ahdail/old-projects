<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Rede social - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/redesocial/listar';" style="float:left;" class="add">Todas as redes</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/redesocial/manter" method="post">

						<fieldset id="personal">
							
							<label for="rede">Nome da rede social<small style="color:red;">*</small> </label> 			
							<input name="rede" style="width:200px" id="rede" type="text" value="<?php echo $row['rede']?>"  />
							<br />
							<label for="link">Link do perfil<small style="color:red;">*</small> </label> 			
							<input name="link" style="width:400px" id="link" type="text" value="<?php echo $row['link']?>"  />
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
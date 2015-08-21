<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">Fotos do Evento - Cadastro<br />  </h3>
                    <p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/eventofoto/pesquisar';" style="float:left;" class="add">Todas as fotos dos eventos</a><p /><br/> <br/>                         
                  
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/eventofoto/manter" enctype="multipart/form-data" method="post">
						
						<fieldset id="personal">

							<legend>Fotos do Evento</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="idevento" >Nome da Evento<small style="color:red;">*</small> </label> 												
			
							
			
							<select name="idevento">			
								<option value="">selecione</option>									
								<?php
								
								foreach ($evento as $rows) { 
								if ($rows['id'] == $row['idEvento']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}
													
								?>
									<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['titulo']?></option>									
								<?php }?>
							</select>
							<br />
							<label for="userfile">Foto<small style="color:red;">*</small> </label> 
							<input name="userfile" id="button1" type="file" /><br /><br />
							
							<?php if ($row['id']){?>
							<font size=1px>Imagem atual</font><br />
							<img src="<?php echo base_url()?>site/eventos_fotos/<?php echo $row['fotoEventoThumb']?>"
							<?php }?> 
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
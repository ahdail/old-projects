<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">Banner - Cadastro<br />  </h3>
                    <p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/banner/listar';" style="float:left;" class="add">Todas as fotos da galeria</a><p /><br/> <br/>                         
                  
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/banner/manter" enctype="multipart/form-data" method="post">
						
						<fieldset id="personal">

							<legend>Banner</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							
							<label>Título<span >*</span></label>
							<input type="text" name="titulo" size="50px" class="campoGd" value="<?php echo $row['titulo']?>">
							
							<br />
							<label>Selecione arquivo<span>*</span></label>
							<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							
							<br />
							<label>Abrir em nova janela </label>
							<input type="checkbox" name="novaJanela" <?php if($row['novaJanela'] == "S") echo "checked=checked";?> value="S"> Sim
							
							<br/>
							
							<label>URL (http://...)</label>
							<input type="text" class="campo" name="url" size="35" value="<?php echo $row['url']?>">
							<br />
							
							
							<!--
							<label>Ordem do banner<span>*</span></label>
							<select name="ordem">
								<option value="1" <?php if($row['ordem'] == 1) echo "selected=selected"; ?>>1</option>
								<option value="2" <?php if($row['ordem'] == 2) echo "selected=selected"; ?>>2</option>
								<option value="3" <?php if($row['ordem'] == 3) echo "selected=selected"; ?>>3</option>
								<option value="4" <?php if($row['ordem'] == 4) echo "selected=selected"; ?>>4</option>
							</select>
							
							<br />
							-->
							<label>Largura<span >*</span></label>
							<input type="text" class="campoPeq" name="largura" size="3" maxlength="3" value="<?php echo ($row['largura']) ? $row['largura'] : "750"; ?>"> pixels
							<br />
							
							<label>Altura<span>*</span></label>
							<input type="text" class="campoPeq" name="altura" size="3" maxlength="3" value="<?php echo ($row['altura']) ? $row['altura'] : "270"; ?>"> pixels
							
							<br />
							
							<label>Exibir banner</label>
							<?php 
								if ($row['exibir'] == "S") {
									$marcadoExibir = "checked=checked";
								} else {
									$marcadoExibir = "";
								}
							?>
							<input type="checkbox" name="exibir"  <?php echo $marcadoExibir?> value="S" checked> Sim
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
<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">Fotos da Galeria - Cadastro<br />  </h3>
                    <p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/galeriafoto/pesquisar';" style="float:left;" class="add">Todas as fotos da galeria</a><p /><br/> <br/>                         
                  
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/galeriafoto/manter" enctype="multipart/form-data" method="post">
						
						<fieldset id="personal">

							<legend>Fotos da Galeria</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							
							<label for="idgaleria" >Nome da Galeria<small style="color:red;">*</small> </label> 												

							<select name="idgaleria">			
								<option value="">selecione</option>									
								<?php
								
								foreach ($galeria as $rows) { 
								if ($rows['id'] == $row['idGaleria']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}
													
								?>
									<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['nomegaleria']?></option>									
								<?php }?>
							</select>
							<br />
							<label for="userfile">Foto<small style="color:red;">*</small> </label> 
							<input name="userfile" id="button1" type="file" /><?php echo $row['id'] ?><br />
							
							<label for="descricao">Descrição da foto<small style="color:red;">*</small> </label> 
							<input type="text" name="descricao" style="width:400px" value="<?php echo $row['descricao']?>"></input>
							<br /><br />
							
							<?php if ($row['id']){?>
							<font size="1px">Imagem atual</font><br />
							<img src="<?php echo base_url()?>site/galeria_fotos/<?php echo $row['fotoGaleriaThumb']?>"
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
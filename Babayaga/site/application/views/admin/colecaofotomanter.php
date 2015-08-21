<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">Fotos da Coleção - Cadastro<br />  </h3>
                    <p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/colecaofoto/pesquisar';" style="float:left;" class="add">Todas as fotos da coleções</a><p /><br/> <br/>                         
                  
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/colecaofoto/manter" enctype="multipart/form-data" method="post">
						
						<fieldset id="personal">

							<legend>Fotos da Coleção</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="idcolecao" >Nome da Coleção<small style="color:red;">*</small> </label> 												
			
							
			
							<select name="idcolecao">			
								<option value="">selecione</option>									
								<?php
								
								foreach ($colecao as $rows) { 
								if ($rows['id'] == $row['idColecao']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}
													
								?>
									<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['nomecolecao']?></option>									
								<?php }?>
							</select>
							<br />
							
							<label for="userfile">Foto<small style="color:red;">*</small> </label> 
							<input name="userfile" id="button1" type="file" /><br /><br />
							
							<label for="descricao" >Descrição<small style="color:red;">*</small> </label> 
							<input name="descricao" id="descricao" style="width:400px" type="text" value="<?php echo $row['descricao']?>"  />
							<br />
							<?php if ($row['id']){?>
							<font size=1px>[Foto atual]<br />
							<img src="<?php echo base_url()?>site/colecao_fotos/<?php echo $row['fotoColecaoThumb']?>"
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
<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Perfil Babayaga - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/babayaga/listar';" style="float:left;" class="add">Todos </a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/babayaga/manter" method="post" enctype="multipart/form-data">

						<fieldset id="personal">
							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="cliente">Cliente<small style="color:red;">*</small> </label> 
							<input name="cliente" id="cliente" style="width:400px" type="text" value="<?php echo $row['cliente']?>"  />
							<br />
							<label for="userfile">Foto</label> 
							<input name="userfile" id="userfile" type="file" value=""  /><br/><i>(somente no formato: .jpg, .gif e no tamanho 100 x 80 )</i>
							<br/><label for="resumo">Resumo<small style="color:red;">*</small> </label> 
							<textarea name="resumo" style="width:700px; height:50px;"><?php echo $row['resumo']?></textarea>
							<br/><label for="descricao">Descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px; height:150px;"><?php echo $row['descricao']?></textarea>
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
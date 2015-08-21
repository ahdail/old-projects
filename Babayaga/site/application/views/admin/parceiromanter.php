<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Parceiros - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/parceiro/listar';" style="float:left;" class="add">Todas os parceiros</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro" ><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/parceiro/manter" method="post" enctype="multipart/form-data">

						<fieldset id="personal">
							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nome">Nome do parceiro<small style="color:red;">*</small> </label> 
							<input name="nome" id="nome" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="userfile">Foto/imagem<small style="color:red;">*</small></label> 
							<input name="userfile" id="userfile" type="file" value="<?php echo $row['foto']?>"  />
							<br />
							<label for="descricao">Descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px; height:150px;"><?php echo $row['descricao']?></textarea>
							<br /><br />							
							<label for="site">Site (http://...) </label> 
							<input name="site" id="site" type="text" value="<?php echo $row['site']?>" />																		
							
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
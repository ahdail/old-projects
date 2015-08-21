<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Vídeo - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/video/listar';" style="float:left;" class="add">Todas os vídeos</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/video/manter" enctype="multipart/form-data" method="post">

						<fieldset id="personal">
						
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="userfile">Imagem<small style="color:red;">*</small> </label> 
							<input name="userfile" id="userfile" style="width:400px" type="file" value=""  />
							<br />
							<label for="titulo">Título do vídeo<small style="color:red;">*</small> </label> 
							<input name="titulo" id="titulo" style="width:400px" type="text" value="<?php echo $row['titulo']?>"  />
							<br />
							<label for="descricao">Breve descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px; height:100px;"><?php echo $row['descricao']?></textarea>
							<br />
							<label for="linkvideo" style="width:500px">Código(script)<small style="color:red;">*</small><i> (copie [ctrl+c] e cole[ctrl+v] o código é gerado pelo youtube)</i></label> 
							<textarea name="linkvideo" style="width:700px; height:150px;"><?php echo $row['linkvideo']?></textarea>
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
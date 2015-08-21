<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Fale Conosco - Mesagens</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/faleconosco/listar';" style="float:left;" class="add">Todas as mensagens</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/faleconosco/manter" method="post">

						<fieldset id="personal">
							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nome">Nome do remetente<small style="color:red;">*</small> </label> 
							<input name="nome" id="nome" style="width:400px" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="email">E-mail<small style="color:red;">*</small> </label> 
							<input name="email" id="email" style="width:400px" type="text" value="<?php echo $row['email']?>"  />
							<br />
							<label for="mensagem">Mensagem<small style="color:red;">*</small> </label> 
							<textarea name="mensagem" style="width:700px; height:150px;"><?php echo $row['mensagem']?></textarea>
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
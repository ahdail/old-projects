<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Galeria - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/galeria/listar';" class="add">Todas as galerias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/galeria/manter" method="post">
						
						
						
						<fieldset id="personal">

							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nomegaleria" >Nome da Galeria<small style="color:red;">*</small> </label> 
							<input name="nomegaleria" id="nomegaleria" style="width:400px" type="text" value="<?php echo $row['nomegaleria']?>"  />
							<br />
							<label for="descricao">Descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:400px"><?php echo $row['descricao']?></textarea>
							<br /><br />
						
							
							
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
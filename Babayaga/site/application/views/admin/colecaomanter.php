<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Coleção - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/colecao/listar';" class="add">Todas as coleções</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/colecao/manter" method="post">

						<fieldset id="personal">

							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nomecolecao" >Nome da Coleção<small style="color:red;">*</small> </label> 
							<input name="nomecolecao" id="nomecolecao" style="width:400px" type="text" value="<?php echo $row['nomecolecao']?>"  />
							<br />
							<label for="descricao">Descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px"><?php echo $row['descricao']?></textarea>
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
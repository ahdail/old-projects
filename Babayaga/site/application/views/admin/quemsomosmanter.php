<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Quem somos</span><br /> 
						
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/quemsomos/manter" method="post">

						<fieldset id="personal">

							<legend>&nbsp; Informações</legend><br />
							
							<label for="descricao">Nossa História<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px; height:100px;"><?php echo $row['descricao']?></textarea>
							<br /><br />
							<label for="misao">Origem do nome<small style="color:red;">*</small> </label> 
							<textarea name="missao" style="width:700px; height:100px;"><?php echo $row['missao']?></textarea>
							<br /><br />
							<!--
							<label for="valores">Valores<small style="color:red;">*</small> </label> 
							<textarea name="valores" style="width:700px;height:100px;"><?php echo $row['valores']?></textarea>
							<br />											
							-->
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
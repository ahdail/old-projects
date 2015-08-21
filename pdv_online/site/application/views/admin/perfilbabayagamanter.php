<?php include 'inicio_inc.php';?>


		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Perfil Babayaga - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/perfilbabayaga/listar';" style="float:left;" class="add">Todos </a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="cliente">Cliente<small style="color:red;">*</small> </label> 
							<input name="cliente" id="cliente" style="width:400px" type="text" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="fonte">Foto</label> 
							<input name="fonte" id="fonte" type="file" value=""  /><br/><i>(somente no formato: .jpg, .gif e no tamanho 100 x 80 )</i>
							<br/><label for="login">Descrição<small style="color:red;">*</small> </label> 
							<textarea style="width:700px; height:150px;"></textarea>
				
							
							
							
						</fieldset>
                      
						<div align="center">
							<input id="button1" type="submit" value="cadastrar" /> 
							<input type="hidden" name="id" value="<?php echo $row['id']?>">
						</div>
				  
                    </form>
					
				</div>

            </div>
			
<?php include 'final_inc.php';?>
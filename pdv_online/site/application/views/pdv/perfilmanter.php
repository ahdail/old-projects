<?php include 'inicio_inc.php';?>

        <div id="wrapper">
		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Categoria de Perfil - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/perfil/listar';" style="float:left;" class="add">Todos as perfis</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?= base_url()?>pdv/perfil/manter" method="post">

						<fieldset id="personal">

							<legend>Perfil</legend>

							<label for="perfil">Perfil </label> 
							<input name="perfil" id="perfil" type="text" tabindex="1" value="<?php echo $row['perfil']?>"  />
							<br />
							
							<label for="sigla">Sigla </label>
							<input name="sigla"  id="sigla" type="text" value="<?php echo $row['sigla']?>" tabindex="1" />
							<br />

						</fieldset>
                      
						<div align="center">
							<input id="button1" type="submit" value="cadastrar" /> 
							<input type="hidden" name="id" value="<?php echo $row['id']?>">
						</div>
				  
                    </form>
					
				</div>

            </div>
			
<?php include 'final_inc.php';?>
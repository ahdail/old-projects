<?php include 'inicio_inc.php';?>

        <div id="wrapper">
		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Categoria de usuário - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuariocategoria/listar';" style="float:left;" class="add">Todas as categorias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?= base_url()?>pdv/usuariocategoria/manter" method="post">

						<fieldset id="personal">

							<legend>Categoria</legend>

							<label for="nomecategoria">Categoria* </label> 
							<input name="nomecategoria" id="nomecategoria" type="text" tabindex="1" value="<?php echo $row['nomecategoria']?>"  />
							<br />
							
							<label for="valor">Valor(R$)* </label>
							<input name="valor"  id="valor" type="text" value="<?php echo $row['valor']?>" tabindex="1" />
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
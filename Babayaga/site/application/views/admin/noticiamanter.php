<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Notícia - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/noticia/listar';" style="float:left;" class="add">Todas as notícias</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/noticia/manter" method="post">

						<fieldset id="personal">

							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="titulo">Título da notícia<small style="color:red;">*</small> </label> 
							<input name="titulo" id="titulo" style="width:400px" type="text" value="<?php echo $row['titulo']?>"  />
							<br />
							<label for="descricao">Descrição<small style="color:red;">*</small> </label> 
							<textarea name="descricao" style="width:700px; height:150px;"><?php echo $row['descricao']?></textarea>
							<br /><br />
							<label for="fonte">Fonte</label> 
							<input name="fonte" id="fonte" style="width:400px" type="text" value="<?php echo $row['fonte']?>"  />&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							<br />
							<label for="site">Site (http://...) </label> 
							<input name="site" id="site" style="width:400px" type="text" value="<?php echo $row['site']?>"  />
							<br />												
							<label for="exibir">Exibir em:<small style="color:red;">*</small> </label>							
							<select name="exibir">							
								<option value="N">Pag. Inicial(notícia)</option>	
								<option value="D">Dica</option>								
							</select>
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
<?php include 'inicio_inc.php';?>

            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Usuário - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>admin/usuario/listar';" style="float:left;" class="add">Todas as mensagens</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div class="msgErro"><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?php echo base_url()?>admin/usuario/manter" method="post">

						<fieldset id="personal">
							
							<small style="color:red;">* campos obrigatório</small><br/>
							<label>Nome<span>*</span></label>
							<input type="text" class="campo" name="nome" value="<?php echo $row['nome']?>" />
							<br />
							<label>Login<span>*</span></label>
							<?php 
								if ($row['id'] > 0) {
									$readonly = "readonly=readonly";
								} else {				
									$readonly = "";
								}
							?>
							<input type="text" class="campo" name="login"  <?php echo $readonly ?> value="<?php echo $row['login']?>" />
							<br />
							<label>Senha<span>*</span></label>
							<input type="password" class="campoPeq" name="senha"  />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							<br />
							<label>Repita senha<span>*</span></label>
							<input type="password" name="rsenha" class="campoPeq" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							<br />
							<!--
							<label>Perfil<span>*</span></label>
							<select class="campo" name="idPerfil" id="idPerfil">
								<option value="" selected="selected"></option>
									<?php foreach ($perfil as $row2) { 
				    				if($row2['id'] == $row['idPerfil']){
				    					$selecionado = "selected";
				    				} else {
				    					$selecionado = "";
				    				}
				    			?>
				    				<option value='<?php echo $row2['id']?>' <?php echo $selecionado?> > <?php echo $row2['perfil']?></option>
								<?php } ?>
				   			</select>
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
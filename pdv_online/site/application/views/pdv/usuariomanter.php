<?php include 'inicio_inc.php';?>

        <div id="wrapper">
		
            <div id="content">
                
				<div id="rightnow">
                    
					<h3 class="reallynow">
                        <span>Usuário - Cadastro</span><br />
                        <a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario/listar';" style="float:left;" class="add">Todas as usuários</a><br />                        
                    </h3>
					
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
					
					<form id="form" action="<?= base_url()?>pdv/usuario/manter" method="post">

						<fieldset id="personal">

							<legend>Dados</legend>
							<small style="color:red;">* campos obrigatório</small><br/>
							<label for="nome">Nome<small style="color:red;">*</small> </label> 
							<input name="nome" id="nome" type="text" tabindex="1" value="<?php echo $row['nome']?>"  />
							<br />
							<label for="login">Login<small style="color:red;">*</small> </label> 
							<input name="login" id="login" type="text" tabindex="1" value="<?php echo $row['login']?>"  />
							<br />
							<label for="senha">Senha<small style="color:red;">*</small></label> 
							<input name="senha" id="senha" type="password" tabindex="1" value=""  />&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
							<br />
							<label for="confirmasenha">Confirmar senhar </label> 
							<input name="confirmasenha" id="confirmasenha" type="password" tabindex="1" value=""  />
							<br />												
							<label for="idPerfil">Perfil<small style="color:red;">*</small> </label>							
							<select name="idPerfil">
							<?php foreach ($row['perfil'] as $rowPerfil) { ?>
								<option value="<?php echo $rowPerfil['id']?>" <?php if ($rowPerfil['id'] == $row['idPerfil']) { echo " selected=\"selected\" "; }?>><?php echo $rowPerfil['perfil']?></option>	
							<?php } ?>								
							</select>
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
<?php include 'inicio.inc.php'?>

<div id="content">
	<div id="content-top">
    <h2>Portal de Projetos</h2>
      <a href="#" id="topLink">Change Order</a> 
      <span class="clearFix">&nbsp;</span>
    </div><!-- end of div#content-top -->
  <div id="left-col">
        <script language="javascript">
			function deletar(id) {
				if (confirm("Deseja realmente deletar?")) {
					window.location.href="<?php echo base_url()?>usuarios/deletar/"+id;
				}
			}
		</script>
          
          <div class="box" style=" margin:0 0 0 0; width:980px;">
		  
		  
              <div class="titulo-menu">
                    <h3>Cadastra Usuários</h3>
                    <span class="titulo-menu-left"></span>
                    <span class="titulo-menu-right"></span>
            	</div>
              <div class="box-container">
                 <div id="quick-send-message-container">
                    
					<form id="form" action="<?php echo base_url()?>usuarios/manter" method="post">
					
					<?php if (validation_errors()) { ?>						
						<span class="form-error-inline" style="padding:0 0 60px 20px "><?php echo validation_errors(); ?></span>						
					<?php } ?>
						
                  		<fieldset>
                  			<!--<legend>Quick Send Message</legend>--->
							
							<p><label>Nome do Usuário*:</label>
                  			<input name="NOME" id="NOME" type="text" value="<?php echo (!isset($row['NOME'])) ? "" : $row['NOME']; ?>"/></p>
							
							<p><label>Login*</label>
                  			<input name="LOGIN" id="LOGIN" type="text" value="<?php echo (!isset($row['LOGIN'])) ? "" : $row['LOGIN']; ?>"/></p>
							
							<p><label>Senha*:</label>
                  			<input name="SENHA" id="SENHA" type="password" value=""/>
							
							<p><label>Repita Senha*:</label>
                  			<input name="REPITASENHA" id="REPITASENHA" type="password" value=""/></p>
							
							<p><label>Email para contato*:</label>
                  			<input name="EMAIL" id="EMAIL" type="text" value="<?php echo (!isset($row['EMAIL'])) ? "" : $row['EMAIL']; ?>"/></p>
							
							<p><label>telefone*:</label>
                  			<input name="TELEFONE" id="TELEFONE" type="text" value="<?php echo (!isset($row['TELEFONE'])) ? "" : $row['TELEFONE']; ?>"/></p>
							
							<p><label>Projeto Participante*:</label>
							
							
							<select name="ID_PROJETO">
							<?php foreach ($projetos as $rows) {
							
								if ($rows['ID_PROJETO'] == $row['ID_PROJETO']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}
							?>	
								<option value="<?php echo $rows['ID_PROJETO']?>" <?php echo $selecionado ?>><?php echo $rows['NOM_PROJETO']?></option>								
							<?php } ?>		
							
							</select>
							
							
                            <div class="inner-nav">
                				
                				<input id="button1" type="submit" value="cadastrar" /> 
                                <span class="clearFix">&nbsp;</span>
                			</div>  	
    	    	          	<input class="hidden" name="button" type="button" value="Send Message" />
							<input type="hidden" name="Id" value="<?php echo (!isset($row['Id'])) ? "" : $row['Id']; ?>">
						
						</fieldset>
						
						
						
                  	</form>
                </div>
	<div class="box-container"> 
				<table class="display" id="groceryCrudTable3">
      			<thead>
      				<tr>      					
                        <td>Nome</td>
						<td>Login</td>
						<td>Projeto Participante</td>
						<td>E-mail</td>
						<td>Telefone</td>						
						
						<td>Ação</td>
      				</tr>
      			</thead>
      			
      			<tbody>
      				<?php foreach ($usuarios as $row) {?>	
					<tr class="odd">
                            <td class="col-first" style="padding:10px"><?php echo $row['NOME']?></td>
							<td class="col-first" style="padding:10px"><?php echo $row['LOGIN']?></td> 
                            <td class="col-first" style="padding:10px"><?php echo $row['ID_PROJETO']?></td> 
							<td class="col-first" style="padding:10px"><?php echo $row['EMAIL']?></td> 
							<td class="col-first" style="padding:10px"><?php echo $row['TELEFONE']?></td> 
							
							<td class="col-first" style="padding:10px">
								<a href="<?php echo base_url()?>usuarios/detalhar/<?php echo $row['Id']?>">[Editar]</a> - 
								<a href="#" onclick="deletar(<?php echo $row['Id']?>)">[Excluir]</a>
							</td>
                    </tr>
					<?php } ?>
      			</tbody>
      		</table> 
			</div>
          </div><!--end of div.box-container -->
          </div><!--end of div.box -->
        
      </div> <!-- end of div#left-col -->
      

        
   

		

      <!-------------------------- INI COLUNA CENTRO ------------------------------>


      
      <span class="clearFix">&nbsp;</span>     
</div><!-- end of div#content -->
<div class="push"></div>
</div><!-- end of #container -->

<?php include  'final.inc.php'?>

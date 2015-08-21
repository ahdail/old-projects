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
					window.location.href="<?php echo base_url()?>noticias/deletar/"+id;
				}
			}
		</script>
          
          <div class="box" style=" margin:0 0 0 0; width:980px;">
		  
		  
              <div class="titulo-menu">
                    <h3>Cadastra Notícia</h3>
                    <span class="titulo-menu-left"></span>
                    <span class="titulo-menu-right"></span>
            	</div>
              <div class="box-container">
                 <div id="quick-send-message-container">
                    
					<form id="form" action="<?php echo base_url()?>noticias/manter" method="post">
					
					<?php if (validation_errors()) { ?>
						
						<span class="form-error-inline" style="padding:0 0 20px 20px "><?php echo validation_errors(); ?></span>
						
					<?php } ?>
						
                  		<fieldset>
                  			<!--<legend>Quick Send Message</legend>--->
							
							<p><label>Titulo da Notícia*:</label>
                  			<input name="titulo" id="titulo" type="text" value="<?php echo (!isset($row['TITULO'])) ? "" : $row['TITULO']; ?>"/></p>
							
							<p><label>Notícia*:</label>
                  			<textarea name="descricao" style="width:800px; height:100px;"><?php echo (!isset($row['DESCRICAO'])) ? "" : $row['DESCRICAO']; ?></textarea></p>
	
                            <div class="inner-nav">
                				
                				<input id="button1" type="submit" value="cadastrar" /> 
                                <span class="clearFix">&nbsp;</span>
                			</div>  	
    	    	          	<input class="hidden" name="button" type="button" value="Send Message" />
        	          	</fieldset>
                  	</form>
                </div>
	<div class="box-container"> 
				<table class="display" id="groceryCrudTable3">
      			<thead>
      				<tr>      					
                        <td>Título</td>
      					<td>Descrição</td>  
						<td>Data Publicação</td>
						<td>Ação</td>
      				</tr>
      			</thead>
      			
      			<tbody>
      				<?php foreach ($noticias as $row) {?>	
					<tr class="odd">
                            <td class="col-first" style="padding:10px"><?php echo $row['TITULO']?></td>
                            <td class="col-first" style="padding:10px"><?php echo $row['DESCRICAO']?></td> 
							<td class="col-first" style="padding:10px"><?php echo sqlToDate($row['DATA_PUBLICACAO'])?></td>
							<td class="col-first" style="padding:10px">
								<a href="<?php echo base_url()?>noticias/detalhar/<?php echo $row['Id']?>">[Editar]</a> - 
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

<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Voz do Cidadão</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/vozcidadao/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/vozcidadao/manter" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Nome</label>
                      <input type="text" name="nome" class="text_field" value="<?php echo $row['nome'];?>" />
                    </div>
					<div class="group">
                      <label class="label">Email</label>
                      <input type="text" name="email" class="text_field" value="<?php echo $row['email'];?>" />
                    </div>
					<div class="group">
					<label class="label">Assunto</label>
                      <select name="id_assunto">
						<option value="">selecione</option>									
						<?php
						
						foreach ($assunto as $rows) { 
						if ($rows['id'] == $row['id_assunto']){
							$selecionado = " selected=\"selected\" ";
						} else {
							$selecionado = "";
						}
											
						?>
							<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['assunto']?></option>									
						<?php }?>
					</select><br /><br />
                    </div>
												
					<div class="group">
                      <label class="label">Mensagem</label>  <span class="description">Mensagem enviada através do site</span><br />
					  <textarea class="text_area" rows="10" name="mensagem" cols="80"><?php echo $row['mensagem']?></textarea>
                      
					
										  
                    </div>
                   
                  </div>
                  <div class="column right">
                    
                    <div class="group">
                      <label class="label">Mostrar no site ?</label>
                      <div>
                        <input type="radio" name="mostrar" id="radio_1" class="checkbox" value="S" <?php echo $row['mostrar'] == "S" ? "checked": ""?>/> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="mostrar" id="radio_2" class="checkbox" value="N" <?php echo $row['mostrar'] == "N" ? "checked": ""?> /> <label for="radio_2" class="radio">Não</label>
                      </div>
                    </div>
                    
                  </div>
                </div>
                 <div class="group navform wat-cf">
                  <button class="button" type="submit">
						<img src="<? echo base_url()?>images/icons/tick.png" /> Salvar
					</button>
										
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
        </div>

        

        

<?php include 'final.inc.php';?>
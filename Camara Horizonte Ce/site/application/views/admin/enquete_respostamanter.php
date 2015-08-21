<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Enquete - Resposta</h2>
            <div class="inner">
			<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/enquete_resposta/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/enquete_resposta/manter"  method="post">
                <div class="columns wat-cf">
                  
				   <div class="column left">
                    
                    <div class="group">
                      <label class="label">Pergunta</label>
                      <select name="id_pergunta">
					  <option value="">selecione</option>									
						<?php
						
						foreach ($perguntas as $rows) { 
						if ($rows['id'] == $row['id_pergunta']){
							$selecionado = " selected=\"selected\" ";
						} else {
							$selecionado = "";
						}
											
						?>
							<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['pergunta']?></option>									
						<?php }?>
					  </select>
                    </div>
                    <div class="group">
                      <label class="label">Resposta 1</label>
                      <input type="text" name="resposta1" class="text_field" value="<?php echo $row['resposta1']?>" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 2</label>
                      <input type="text" name="resposta2" class="text_field" value="<?php echo $row['resposta2']?>" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 3</label>
                      <input type="text" name="resposta3" class="text_field" value="<?php echo $row['resposta3']?>" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 4</label>
                      <input type="text" name="resposta4" class="text_field" value="<?php echo $row['resposta4']?>" />
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
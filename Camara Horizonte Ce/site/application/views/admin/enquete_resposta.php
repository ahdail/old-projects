<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Enquete - Resposta</h2>
            <div class="inner">
              <form class="form" action="<?php echo base_url()?>admin/enquete/manter"  method="post">
                <div class="columns wat-cf">
                  
				   <div class="column left">
                    
                    <div class="group">
                      <label class="label">Pergunta</label>
                      <select name="id_pergunta">
					  <option value="1">Pergunta 1</option>
					    <option value="2">Pergunta 2</option>
					  </select>
                    </div>
                    <div class="group">
                      <label class="label">Resposta 1</label>
                      <input type="text" name="resposta1" class="text_field" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 2</label>
                      <input type="text" name="resposta4" class="text_field" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 3</label>
                      <input type="text" name="resposta3" class="text_field" />
                    </div>
					<div class="group">
                      <label class="label">Resposta 4</label>
                      <input type="text" name="resposta4" class="text_field" />
                    </div>
                  </div>

                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit">
                    <img src="<? echo base_url()?>images/icons/tick.png" /> Salvar
                  </button>
                  <a href="#header" class="button">
                    <img src="<? echo base_url()?>images/icons/cross.png" /> Cancelar
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>

        

        

      <?php include 'final.inc.php';?>
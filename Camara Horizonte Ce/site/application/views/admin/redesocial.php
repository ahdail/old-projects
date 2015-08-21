<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Rede Social</h2>
            <div class="inner">
             <form action="#" class="form" action="<?php echo base_url()?>admin/redesocial/manter" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Link</label>
                      <input type="text" name="link" class="text_field" />
                    </div>
					
                   
                  </div>
                  <div class="column right">
                    
                    <div class="group">
                      <label class="label">Rede social</label>
                      <select name="rede">
					  <option value="T">Twitter</option>
					    <option value="F">Facebook</option>
					  </select>
                    </div>
                    
                  </div>
                </div>
                 <div class="group navform wat-cf">
                  <button class="button" type="submit">
                    <img src="images/icons/tick.png" alt="Salvar" /> Salvar
                  </button>
                  <a href="#header" class="button">
                    <img src="images/icons/cross.png" alt="Cancelar"/> Cancelar
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>

<?php include 'final.inc.php';?>
<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms">
          
          <div class="content">
            <h2 class="title">Comissão</h2>
            <div class="inner">
              <form action="#" method="post" class="form">
                <div class="group">
                  <label class="label">Nome da comissão</label>
                  <input type="text"  name="nome" class="text_field" />            
                </div>
                
                <div class="group">
                  <label class="label">Descrição</label>
                  <textarea class="text_area" name="descricao" rows="10" cols="80"></textarea>                  
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
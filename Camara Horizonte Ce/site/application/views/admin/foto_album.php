<?php include 'inicio.inc.php';?>
        

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Álbum</h2>
            <div class="inner">
              <form action="#" class="form" action="<?php echo base_url()?>admin/foto/" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Nome</label>
                      <input type="text" name="nome" class="text_field" />
                    </div>
					<div class="group">
                      <label class="label"><a href="<? echo base_url()?>admin/foto/imagem">Cadastrar imagem</a></label>                     
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
<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Vereadores</h2>
            <div class="inner">
              <form action="#" class="form" action="<?php echo base_url()?>admin/vereadores/manter" enctype="multipart/form-data" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Nome</label>
                      <input type="text" name="nome" class="text_field" />
                    </div>
					<div class="group">
                      <label class="label">Foto</label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>            
                    </div>
                    <div class="group">
                      <label class="label">Informações</label><span class="description">Ramail, E-mail, sala</span>
                      <textarea class="text_area" rows="10" name="informacao" cols="80"></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Partido</label>
                      <select name="partido"><option value="1">Choose...</option></select>
                    </div>
                    <div class="group">
                      <label class="label">Presidente?</label>
                      <div>
                        <input type="radio" name="presidente" id="radio_1" class="checkbox" value="S" /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="presidente" id="radio_2" class="checkbox" value="N" /> <label for="radio_2" class="radio">Não</label>
                      </div>
                    </div>
                    <div class="group">
                      <label class="label">Mesa diretora?</label>
                      <div>
                        <input type="radio" name="mesa_diretora" id="radio_1" class="checkbox" value="S" /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="mesa_diretora" id="radio_2" class="checkbox" value="N" /> <label for="radio_2" class="radio">Não</label>
                      </div>
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
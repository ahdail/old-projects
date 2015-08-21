<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Apoio & Serviço</h2>
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
                      <textarea class="text_area" name="informacao" rows="10" cols="80"></textarea>
                    </div>
                  </div>
                  <div class="column right">
                     <div class="group">
                      <label class="label">Exibir em</label>
                      <select name="exibir">
						<option value="1">Apoio</option>
						<option value="1">Serviços</option>
					  </select>
                    </div>
                    <div class="group">
                      <label class="label">Mostrar no site ?</label>
                      <div>
                        <input type="radio" name="mostrar" id="radio_1" class="checkbox" value="1" /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="mostrar" id="radio_2" class="checkbox" value="2" /> <label for="radio_2" class="radio">Não</label>
                      </div>
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
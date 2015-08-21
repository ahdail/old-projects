<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms">
          
          <div class="content">
            <h2 class="title">Cadastrar Notícia</h2>
            <div class="inner">
              <form action="#" class="form" action="<?php echo base_url()?>admin/banner/manter" enctype="multipart/form-data" method="post">
                <div class="group">
                  <label class="label">Título</label>
                  <input type="text" name="titulo" class="text_field" />            
                </div>
				<div class="group">
                  <label class="label">Resumo</label>
                  <input type="text" name="resumo" class="text_field" />            
                </div>
                <div class="group">
                  <label class="label">Imagem</label>
                  <input type="file" name="userfile" size="50" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>            
                </div>
                <div class="group">
                  <label class="label">Notícia</label>
                  <textarea class="text_area" name="noticia" rows="10" cols="80"></textarea>
                  
                </div>
				<div>
				  <input type="checkbox" name="destque" id="checkbox_1" class="checkbox" value="S" /> <label for="checkbox_1" class="checkbox">Destaque</label>
				  </div>
				  <div>
					<input type="checkbox" name="materia_especial" id="checkbox_2" class="checkbox" value="S" /> <label for="checkbox_2" class="checkbox">Matéria especial</label>
				</div>
				<br />
					  
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
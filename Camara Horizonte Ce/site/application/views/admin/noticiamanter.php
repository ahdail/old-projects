<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms">
          
          <div class="content">
            <h2 class="title">Cadastrar Notícia</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/noticia/listar">Ver todas</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/noticia/manter" enctype="multipart/form-data" method="post">
                <div class="group">
                  <label class="label">Título</label>
                  <input type="text" name="titulo" class="text_field" value="<?php echo $row['titulo']?>"/>            
                </div>
				<div class="group">
                  <label class="label">Resumo</label>
                  <input type="text" name="resumo" class="text_field" value="<?php echo $row['resumo']?>" />            
                </div>
                <div class="group">
                  <label class="label">Imagem</label>
                  <input type="file" name="userfile" size="50" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br/><br/>
				  <?php if ( $row['imagem']){?> 
					<img src="<? echo base_url()?>site/img/<?php echo $row['imagem']?>" /><br />
					<font size=1px>[Imagem Atual]</font>
				  <?php }?>
                </div>
                <div class="group">
                  <label class="label">Notícia</label>
                  <textarea class="text_area" name="noticia" rows="10" cols="80"><?php echo $row['resumo']?></textarea>
                  
                </div>
				<div>
				  <input type="checkbox" name="destaque" id="checkbox_1" class="checkbox" value="S" <?php echo $row['destaque'] == "S" ? "checked": ""?>"  /> <label for="checkbox_1" class="checkbox">Destaque</label>
				  </div>
				  <div>
					<input type="checkbox" name="materia_especial" id="checkbox_2" class="checkbox" value="S" <?php echo $row['materia_especial'] == "S" ? "checked": ""?> /> <label for="checkbox_2" class="checkbox">Matéria especial</label>
				</div>
				<br />
					  
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
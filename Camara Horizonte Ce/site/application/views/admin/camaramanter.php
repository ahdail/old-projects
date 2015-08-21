<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms">
          
          <div class="content">
            <h2 class="title">A Câmara</h2>
            <div class="inner">
              <form class="form" action="<?php echo base_url()?>admin/camara/manter" method="post">
                <div class="group">
                  <label class="label">Titulo</label>
                  <input type="text" name="titulo" value="<?php echo $row['titulo']?>" class="text_field" />            
                </div>
                <div class="group">
                      <label class="label">Imagem <font size=1px> - Organograma da Câmara</font></label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br />
					<?php if ( $row['imagem']){?> 
						<img src="<? echo base_url()?>site/img/<?php echo $row['imagem_pq']?>" /><br />
						<font size=1px>[Imagem Atual]</font>
					  <?php }?>
					  
                </div>
                <div class="group">
                  <label class="label">Descrição</label>
                  <textarea class="text_area" name="descricao" rows="10" cols="80"><?php echo $row['descricao']?></textarea>
                  
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
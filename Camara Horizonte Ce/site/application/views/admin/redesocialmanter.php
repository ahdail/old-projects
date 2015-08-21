<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Rede Social</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/redesocial/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
             <form class="form" action="<?php echo base_url()?>admin/redesocial/manter" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Link</label>
                      <input type="text" name="link" class="text_field" value="<?php echo $row['link']?>" />
                    </div>
					
                   
                  </div>
                  <div class="column right">
                    
                    <div class="group">
                      <label class="label">Rede social</label>
                      <select name="redesocial">
						<option value="T" <?php if ($row['rede'] == "T") echo "selected";?>>Twitter</option>
					    <option value="F" <?php if ($row['rede'] == "F") echo "selected";?>>Facebook</option>
					  </select>
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
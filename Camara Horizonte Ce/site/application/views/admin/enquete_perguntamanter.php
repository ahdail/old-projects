<?php include 'inicio.inc.php';?>
        

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Enquete - Pergunta</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/enquete_pergunta/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/enquete_pergunta/manter"  method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Pergunta</label>
                      <input type="text" name="pergunta" class="text_field" value="<?php echo $row['pergunta']?>" />
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
<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms">
          
          <div class="content">
            <h2 class="title">Serviços ao Cidadão</h2>
            <div class="inner">
              <form class="form" action="<?php echo base_url()?>admin/servico/manter" method="post">
                                
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
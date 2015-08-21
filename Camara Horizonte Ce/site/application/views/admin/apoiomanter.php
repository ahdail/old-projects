<?php include 'inicio.inc.php';?>
        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Apoio & Parceiros</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/apoio/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/apoio/manter" enctype="multipart/form-data" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Nome</label>
                      <input type="text" name="nome" class="text_field" value="<?php echo $row['nome']?>" />
                    </div>
					<div class="group">
                      <label class="label">Foto</label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br />
					<?php if ( $row['imagem']){?> 
						<img src="<? echo base_url()?>site/parceiros/<?php echo $row['imagem']?>" /><br />
						<font size=1px>[Imagem Atual]</font>
					  <?php }?>
                    </div>
                    <div class="group">
                      <label class="label">Informações</label><span class="description">Ramail, E-mail, sala</span>
                      <textarea class="text_area" name="informacao" rows="10" cols="80"><?php echo $row['informacao']?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                     <div class="group">
                      <label class="label">Exibir em</label>
                      <select name="exibir_em">
						<option value="A" <?php if($row['exibir_em'] == "A") { echo "selected";}?>>Apoio</option>
						<option value="S" <?php if($row['exibir_em'] == "S") { echo "selected";}?>>Serviços</option>
					  </select>
                    </div>
                    <div class="group">
                      <label class="label">Mostrar no site ?</label>
                      <div>
                        <input type="radio" name="mostrar" id="radio_1" class="checkbox" value="S" <?php echo $row['mostrar'] == "S" ? "checked": ""?> /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="mostrar" id="radio_2" class="checkbox" value="N" <?php echo $row['mostrar'] == "N" ? "checked": ""?> /> <label for="radio_2" class="radio">Não</label>
                      </div>
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
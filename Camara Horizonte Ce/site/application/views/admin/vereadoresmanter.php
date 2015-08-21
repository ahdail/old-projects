<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Vereadores</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/vereadores/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/vereadores/manter" enctype="multipart/form-data" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Nome</label>
                      <input type="text" name="nome" class="text_field" value="<?php echo $row['nome']?>" />
                    </div>
					<div class="group">
                      <label class="label">Email</label>
                      <input type="text" name="email" class="text_field" value="<?php echo $row['email']?>" />
                    </div>
					<div class="group">
                      <label class="label">Foto</label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br />
					<?php if ( $row['imagem']){?> 
						<img src="<? echo base_url()?>site/foto_vereadores/<?php echo $row['imagem']?>" /><br />
						<font size=1px>[Imagem Atual]</font>
					  <?php }?>
                    </div>
                    <div class="group">
                      <label class="label">Informações</label><span class="description">Ramail, E-mail, sala</span>
                      <textarea class="text_area" rows="10" name="informacao" cols="80"><?php echo $row['informacao']?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Partido</label>
                    <select name="id_partido">
						<option value="">selecione</option>									
						<?php						
							foreach ($partidos as $rows) { 
								if ($rows['id'] == $row['id_partido']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
							}											
						?>
							<option value="<?php echo $rows['id']?>" <?php echo $selecionado ?>><?php echo $rows['nome']?></option>									
						<?php }?>
					</select>
                    </div>
                    <div class="group">
                      <label class="label">Presidente?</label>
                      <div>
                        <input type="radio" name="presidente" id="radio_1" class="checkbox" value="S" <?php echo $row['presidente'] == "S" ? "checked": ""?> /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="presidente" id="radio_2" class="checkbox" value="N" <?php echo $row['presidente'] == "N" ? "checked": ""?> /> <label for="radio_2" class="radio">Não</label>
                      </div>
                    </div>
                    <div class="group">
                      <label class="label">Mesa diretora?</label>
                      <div>
                        <input type="radio" name="mesa_diretora" id="radio_1" class="checkbox" value="S" <?php echo $row['mesa_diretora'] == "S" ? "checked": ""?> /> <label for="radio_1" class="radio">Sim</label>
                      </div>
                      <div>
                        <input type="radio" name="mesa_diretora" id="radio_2" class="checkbox" value="N" <?php echo $row['mesa_diretora'] == "N" ? "checked": ""?>/> <label for="radio_2" class="radio">Não</label>
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
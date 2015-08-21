<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Lei & Legislação</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/lei/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/lei/manter" enctype="multipart/form-data" method="post">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Título</label>
                      <input type="text" name="titulo" class="text_field" value="<?php echo $row['titulo']?>" />
                    </div>
					<div class="group">
                      <label class="label">Arquivo</label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br />
						<?php if ( $row['arquivo']){?> 
						<a href="<?php echo base_url()?>site/documentos/<?php echo $row['arquivo']?>" target="_blank"><?php echo $row['arquivo']?></a><br />
						<font size=1px>[Arquivo Atual]</font>
						<?php }?>
                    </div>
                    <div class="group">
                      <label class="label">Descricão</label><span class="description"></span>
                      <textarea class="text_area" rows="10" name="descricao" cols="80"><?php echo $row['descricao']?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Exibir em</label>
                    <select name="exibir_em">
						<option value="">selecione</option>															
							<option value="lei" <?php echo $row['exibir_em'] == "lei" ? " selected=\"selected\"  ": ""?>>Lei Municipal</option>
							<option value="leg" <?php echo $row['exibir_em'] == "leg" ? " selected=\"selected\"  ": ""?>>Legislação</option>						
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
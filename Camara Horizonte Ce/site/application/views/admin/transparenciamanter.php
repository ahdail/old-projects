<?php include 'inicio.inc.php';?>

        <div class="block" id="block-forms-2">
          
          <div class="content">
            <h2 class="title">Portal da Transparência</h2>
            <div class="inner">
				<div class="actions" style="float:rigth">
					<img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/transparencia/listar">Ver todos</a>
				</div>
				<br />
				<?php if (validation_errors()) { ?>
					<div class="msgErro"><?php echo validation_errors(); ?></div>
				<?php } ?>
              <form class="form" action="<?php echo base_url()?>admin/transparencia/manter" enctype="multipart/form-data" method="post">
                
                  
                    <div class="group">
						<label class="label">Titulo</label>
						<input type="text" name="titulo" value="<?php echo $row['titulo']?>" class="text_field" />            
					</div>
					<div class="group">
                      <label class="label">Arquivo</label>
                      <input type="file" name="userfile" size="37" class="text_field" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?><br />
					<?php if ( $row['doc']){?> 
						<a href="<?php echo base_url()?>site/doctransparencia/<?php echo $row['doc']?>" target="_blank"/><?php echo $row['doc']?></a><br />
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


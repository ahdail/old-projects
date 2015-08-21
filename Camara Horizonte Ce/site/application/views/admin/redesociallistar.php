<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/redesocial/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Redes Sociais - Listagem</h2>
			
            <div class="inner">
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/redesocial/manter">Cadastrar Novo(a)</a>
				</div>
				<br />

              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Link</th>
					<th>Tipo</th>					
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($redesocial as $row) {?>	
                  <tr class="odd">                    								
					<td><?php echo $row['link']?></td>					
					<td><?php echo $row['rede']  == "T" ? "Twitter": "Facebook"?></td>				
					<td >
						<a href="<?php echo base_url()?>admin/redesocial/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/redesocial/manter">Cadastrar Novo(a)</a>
                  </div>
                  <div class="pagination">
                    <?php echo $pag;?>							
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <?php include 'final.inc.php';?>

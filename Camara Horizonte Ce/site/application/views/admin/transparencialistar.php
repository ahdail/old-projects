<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/transparencia/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Portal da Transparência</h2>
			
            <div class="inner">
				
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/transparencia/manter">Cadastrar Novo</a>
				</div>
				<br />
				
              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Titulo</th>
                    
					<th>Arquivo</th>						
                    <th>Ação</th>                   
                  </tr>
                  <?php foreach ($transparencia as $row) {?>	
                  <tr class="odd">                    				
					<td><?php echo $row['titulo'];?></td>
					<td><a href="<?php echo base_url()?>site/doctransparencia/<?php echo $row['doc']?>" /><?php echo $row['doc']?></td>

					<td >
						<a href="<?php echo base_url()?>admin/transparencia/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
				
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/transparencia/manter">Cadastrar Novo</a>
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

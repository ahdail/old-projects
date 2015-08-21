<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/servico/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">O Município</h2>
			
            <div class="inner">
				              
                <table class="table">
                  <tr>                                      
					<th>Descrição dos Serviço</th>							
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($servico as $row) {?>	
                  <tr class="odd">                    				
					<td><?php echo $row['descricao']?></td>							
					<td >
						<a href="<?php echo base_url()?>admin/servico/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>				
           
            </div>
          </div>
        </div>
        
        <?php include 'final.inc.php';?>

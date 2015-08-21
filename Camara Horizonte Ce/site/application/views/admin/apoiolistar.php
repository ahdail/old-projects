<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/apoio/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Apoio & Parceiros - Listagem</h2>
			
            <div class="inner">
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/apoio/manter">Cadastrar Novo(a)</a>
				</div>
				<br />

              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Foto</th>
					<th>Nome</th>
					<th>Exibir em </th>	
					<th>Mostrar no site</th>						
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($apoio as $row) {?>	
                  <tr class="odd">                    			
					<td><img src="<? echo base_url()?>site/parceiros/<?php echo $row['imagem_pq']?>" /></td>	
					<td><?php echo $row['nome']?></td>
					<td><?php echo $row['exibir_em'] == "A" ? "Apoio": "Serviços"?> </td>	
					<td><?php echo $row['mostrar']  == "S" ? "Sim": "Não"?></td>				
					<td >
						<a href="<?php echo base_url()?>admin/apoio/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/apoio/manter">Cadastrar Novo(a)</a>
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

<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/vereadores/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Vereadores - Listagem</h2>
			
            <div class="inner">
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/vereadores">Cadastrar Novo(a)</a>
				</div>
				<br />

              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Foto</th>
					<th>Vereador</th>
					<th>Partido</th>	
					<th>Presidente</th>	
					<th>Mesa Diretora</th>	
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($vereadores as $row) {?>	
                  <tr class="odd">                    			
					<td><img src="<? echo base_url()?>site/foto_vereadores/<?php echo $row['imagem']?>" /></td>	
					<td><?php echo $row['nome']?></td>
					<td><?php echo $row['nome_partido']?></td>						
					<td><?php echo $row['presidente'] == "S" ? "Sim": "Não"?> </td>	
					<td><?php echo $row['mesa_diretora']  == "S" ? "Sim": "Não"?></td>				
					<td >
						<a href="<?php echo base_url()?>admin/vereadores/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/vereadores">Cadastrar Novo(a)</a>
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

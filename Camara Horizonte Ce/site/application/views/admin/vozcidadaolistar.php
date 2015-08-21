<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/vozcidadao/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Voz do Cidadão - Listagem</h2>
			
            <div class="inner">
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/vozcidadao">Cadastrar Novo(a)</a>
				</div>
				<br />

              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Nome</th>
					<th>Email</th>
					<th>Assunto</th>
					<th>Mostrar no site</th>	
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($vozcidadao as $row) {?>	
                  <tr class="odd">                    			
					<td><?php echo $row['nome']?></td>	
					<td><?php echo $row['email']?></td>
					<td><?php echo $row['assunto']?></td>							
					<td><?php echo $row['mostrar']  == "S" ? "Sim": "Não"?></td>				
					<td >
						<a href="<?php echo base_url()?>admin/vozcidadao/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/vozcidadao">Cadastrar Novo(a)</a>
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

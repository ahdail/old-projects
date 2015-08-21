<?php include 'inicio.inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/noticia/deletar/"+id;
		}
	}
</script>   

        <div class="block" id="block-tables">
          
          <div class="content">
            <h2 class="title">Notícias - Listagem</h2>
			
            <div class="inner">
				<div class="actions" style="float:rigth">
						<img src="<? echo base_url()?>images/icons/tick.png" />
						<a href="<?php echo base_url()?>admin/noticia/manter">Cadastrar Nova</a>
				</div>
				<br />

              <form action="#" class="form">
                <table class="table">
                  <tr>                  
                    <th>Título</th>
					<th>Resumo</th>	
					<th>Imagem</th>	
					<th>Destaque</th>	
					<th>Materia Especial</th>	
                    <th>Ação</th>                    
                  </tr>
                  <?php foreach ($noticia as $row) {?>	
                  <tr class="odd">                    				
					<td><?php echo $row['titulo']?></td>
					<td><?php echo $row['resumo']?></td>	
					<td><img src="<? echo base_url()?>site/img/<?php echo $row['imagem']?>" /></td>	
					<td><?php echo $row['destaque'] == "S" ? "Sim": "Não"?> </td>	
					<td><?php echo $row['materia_especial']  == "S" ? "Sim": "Não"?></td>				
					<td >
						<a href="<?php echo base_url()?>admin/noticia/detalhar/<?php echo $row['id']?>"">Editar</a> | 
						<a href="#" onclick="deletar(<?php echo $row['id']?>)">Excluir</a>
					</td>
                  </tr>
                  <?php }?>                  
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions" >
                    <img src="<? echo base_url()?>images/icons/tick.png" />
					<a href="<?php echo base_url()?>admin/noticia/manter">Cadastrar Nova</a>
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
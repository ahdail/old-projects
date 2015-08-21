<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/video/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Vídeo - Todos os Vídeos</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/video/manter';" class="add">Novo vídeo</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<th>Titulo</th>
                                <th>Descrição</th>
                                <th>Img Vídeo</th>                                
                                <th width="40px">Acão</th>
                            </tr>
						</thead>
						<tbody>
						<?php foreach ($video as $row) {?>
							<tr>                            	
								<td><?php echo $row['titulo']?></td>
                                <td><?php echo $row['descricao']?></td>
                                <td><img src="<?php echo base_url()?>site/video_fotos/<?php echo $row['fotoVideoThumb']?>"/></td>                                
								<td>								
									<a href="<?php echo base_url()?>admin/video/detalhar/<?php echo $row['id']?>"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Editar" width="16" height="16" /></a>
									<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Excluir" width="16" height="16" /></a>									
								</td>
                            </tr>
						<?php } ?>	
						</tbody>
					</table>
                    <div id="pager" class="a-center">
                    	<?php echo $pag;?>
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
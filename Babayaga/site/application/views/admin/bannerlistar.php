<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/banner/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Banner - Listagem </h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/banner/manter';" class="add">Novo Banner</a><br /></p>
                	<table width="100%">
						<thead>
							<tr>                            	
                            	<td align="center"   width="60px">Título</td>
								
								<td align="center">Banner</td>
								<td align="center" width="10px;">Exibir</td>
								<td align="center" width="10px;">Altura</td>
								<td align="center" width="10px;">Largura</td>
								<td align="center" width="100px;">Nova Janela</td>
												
                                <th width="40px">Ação</th>
                            </tr>
						</thead>
						<tbody>
							<?php foreach ($banner as $row) {?>					
							<tr style="background-color: <?php echo$cor?>" class="acoes">
								<td style="font-size: 11px" align="center"><?php echo$row['titulo']?></td>
								
								<td style="font-size: 11px" align="center">
								<?php if ($row['tipo'] == 1){?>
									<embed src="<?php echo base_url()?>site/banners/<?php echo $row['arquivo']?>" width="150" height="150" allowscriptaccess="always" allowfullscreen="true">
								<?php } else {?>
									<img src="<?php echo base_url()?>site/banners/<?php echo $row['arquivo']?>" width="150" height="90">
								<?php }?>
								</td style="font-size: 11px" align="center">
								<?php if ($row['exibir'] == "S"){ ?>
								<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/N/1"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
								<?php } else { ?>
								<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/S/1"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
								<?php }?>
								<td style="font-size: 11px" align="center"><?php echo $row['altura']?></td>
								<td style="font-size: 11px" align="center"><?php echo$row['largura']?></td>
								<?php if ($row['novaJanela'] == "S"){ ?>
								<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/N/2"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
								<?php } else { ?>
								<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/S/2"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
								<?php }?>
								
								<td align="center" class="acoes">
									<a href="<?php echo base_url()?>admin/banner/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
									<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
								</td>
							</tr>
							<?}?>	
						</tbody>
					</table>
                    <div id="pager" class="a-center">
                    	<?php echo $pag;?>
                    </div>
                </div>
                        
		</div>
         
<?php include 'final_inc.php';?>
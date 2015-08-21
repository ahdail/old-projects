<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/colecaofoto/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Coleção de fotos</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/colecaofoto';" style="float:left;" class="add">Adicionar foto</a><p /><br/> <br/>                         
					<form id="form" action="<?php echo base_url()?>admin/colecaofoto/listar" method="post">

						<fieldset id="personal">
							<legend>Selecione uma Coleção</legend>
							<select name="idcolecao" >			
								<option value="">selecione</option>									
								<?php foreach ($colecao as $row) { 
								if ($row['id'] == $colecaofoto[0]['idColecao']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}													
								?>
									<option value="<?php echo $row['id']?>" <?php echo $selecionado ?>><?php echo $row['nomecolecao']?></option>									
								<?php }?>
							</select>
							<br /><br />
							<div >
								<input id="button1" type="submit" value="Pesquisar" /> 													
							</div>
						</fieldset>
						
                    </form>
				
				
					<div>									
						<?php if($colecaofoto[0]['idColecao']){?>												
						<form id="form" action="<?php echo base_url()?>admin/galeriafoto/listar" method="post">

							<fieldset id="personal">
								<legend><?php echo $colecaofoto[0]['nomecolecao']?></legend>															
									<div id="fotos_">
										<span class="Titulos_colecoes">  </span>
											<p class="foto">
												<?php foreach ($colecaofoto as $row) { ?>												
													<td>
														<a href="<?php echo base_url()?>admin/colecaofoto/detalhar/<?php echo $row['id']?>">
														<img src="<?php echo base_url();?>site/colecao_fotos/<?php echo $row['fotoColecaoThumb']?>" border="0" class="foto" title="Editar" />																				
														</a>
														<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete" width="16" height="16" /></a>									
													</td>																					
												<?php } ?>	
											</p>
									</div>
							</fieldset>						
						</form>						
						<?php }?>
					</div>

                </div>

                      
		</div>
         
<?php include 'final_inc.php';?>
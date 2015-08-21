<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/eventofoto/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Fotos dos Eventos</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/eventofoto';" style="float:left;" class="add">Adicionar foto</a><p /><br/> <br/>                         
					<form id="form" action="<?php echo base_url()?>admin/eventofoto/listar" method="post">

						<fieldset id="personal">
							<legend>Selecione uma Coleção</legend>
							<select name="idevento" >			
								<option value="">selecione</option>									
								<?php foreach ($evento as $row) { 
								if ($row['id'] == $eventofoto[0]['idEvento']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}													
								?>
									<option value="<?php echo $row['id']?>" <?php echo $selecionado ?>><?php echo $row['titulo']?></option>									
								<?php }?>
							</select>
							<br /><br />
							<div >
								<input id="button1" type="submit" value="Pesquisar" /> 													
							</div>
						</fieldset>
						
                    </form>
				
					<div>									
						<?php if($eventofoto[0]['idEvento']){?>												
						<form id="form" action="<?php echo base_url()?>admin/eventofoto/listar" method="post">

							<fieldset id="personal">
								<legend><?php echo $eventofoto[0]['titulo']?></legend>															
									<div id="fotos_">
										<span class="Titulos_colecoes">  </span>
											<p class="foto">
												<?php foreach ($eventofoto as $row) { ?>												
													<td>
														<a href="<?php echo base_url()?>admin/eventofoto/detalhar/<?php echo $row['id']?>">
															<img src="<?php echo base_url();?>site/eventos_fotos/<?php echo $row['fotoEventoThumb']?>" border="0" class="foto" title="Editar" />																				
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
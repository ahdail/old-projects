<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/galeriafoto/deletar/"+id;
		}
	}
</script>

		<div id="content">               
				<div id="box">
                	<h3>Galeria de fotos</h3>
					<p><a href="#" onclick="window.location.href='<?php echo base_url()?>admin/galeriafoto';" style="float:left;" class="add">Adicionar foto</a><p /><br/> <br/>                         
					<form id="form" action="<?php echo base_url()?>admin/galeriafoto/listar" method="post">

						<fieldset id="personal">
							<legend>Selecione uma Galeria</legend>
							<select name="idgaleria" >			
								<option value="">selecione</option>									
								<?php foreach ($galeria as $row) { 
								if ($row['id'] == $galeriafoto[0]['idGaleria']){
									$selecionado = " selected=\"selected\" ";
								} else {
									$selecionado = "";
								}													
								?>
									<option value="<?php echo $row['id']?>" <?php echo $selecionado ?>><?php echo $row['nomegaleria']?></option>									
								<?php }?>
							</select>
							<br /><br />
							<div >
								<input id="button1" type="submit" value="Pesquisar" /> 													
							</div>
						</fieldset>
						
                    </form>

					<div>									
						<?php if($galeriafoto[0]['idGaleria']){?>												
						<form id="form" action="<?php echo base_url()?>admin/galeriafoto/listar" method="post">

							<fieldset id="personal">
								<legend><?php echo $galeriafoto[0]['nomegaleria']?></legend>															
									<div id="fotos_">
										<span class="Titulos_colecoes">  </span>
											<p class="foto">
												<?php foreach ($galeriafoto as $row) { ?>												
													<td>
														<a href="<?php echo base_url()?>admin/galeriafoto/detalhar/<?php echo $row['id']?>">
														<img src="<?php echo base_url();?>site/galeria_fotos/<?php echo $row['fotoGaleriaThumb']?>" border="0" class="foto" title="Editar" />																				
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
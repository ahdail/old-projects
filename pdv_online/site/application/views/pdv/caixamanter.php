<?php include 'inicio_inc.php';?>

        <div id="wrapper">
            <div id="content">
	
				<div id="rightnow">
                    <h3 class="reallynow">
                        <span>Caixa - <?php echo $numCaixa;?></span><br />											
						<?php if ($novocaixa){?> 
							<a href="#" onclick="mostrar();" style="float:left;" class="add">Nova venda</a>						
						<?php } ?>						
                        <br />
                    </h3>
					<?php if (validation_errors()) { ?>
						<div><?php echo validation_errors(); ?></div>
					<?php } ?>
				   <form id="form" action="<?= base_url()?>pdv/venda/realizaVenda/<?php echo $numCaixa;?>/<?php echo $session_idUsuario;?>" method="post">
						
				<script>
					function mostrar() {
						obj1 = document.getElementById("div1");
						if (obj1.style.display=='block') {
							obj1.style.display='none';
						} else {
							obj1.style.display='block';
						}
					}
				</script>

<!--Fica escondido até o vendedor clicar em "nova loja"-->	
<div id='div1' style="display:none;">
										
					<?php if ($totalGeral['valorTotal']){?>
					<p>Valor vendido: <?php echo "R$ ".converteValor($totalGeral['valorTotal']);?> </p>						
					<?php } ?>
                      <fieldset id="personal">
					 
                        <legend>Realizar vendas</legend>
						
                        <label>&nbsp;</label>
						<b>Quantidade - R$/pessoa - SubTotal </b>
                        <br />
						<script language="Javascript">
							function calculo(id){
								
								document.getElementById("valorSubTotalCategoria_"+id).value = '0'
								var valorUniCategoria = parseFloat(document.getElementById("valorUniCategoria_"+id).value);
								var qtdCategoria = parseFloat(document.getElementById("qtdCategoria_"+id).value);
								if(isNaN(qtdCategoria)){
									document.getElementById("valorSubTotalCategoria_"+id).value = "0";			
								} else {
									var Subtotal = valorUniCategoria * qtdCategoria;
									document.getElementById("valorSubTotalCategoria_"+id).value = Subtotal.toFixed(2) ;	
								}
								
								
							}
							
						</script>
						<?php foreach ($categoriausuarios as $row) { 
						
							// Monta os campos dinâmicos (concatenando)
							$campos ="<label>".$row['nomecategoria']."</label>";
							$campos.="<input name=\"qtdCategoria[]\" value = \"0\" size=\"6\" id=\"qtdCategoria_".$row['id']."\" type=\"text\" onblur=\"calculo(".$row['id'].")\" />";
							$campos.="<input name=\"valorUniCategoria\" size=\"6\" id=\"valorUniCategoria_".$row['id']."\" type=\"text\" style=\"text-align:center;\" DISABLED value=\"".converteValor($row['valor'])."\"/>";														
							$campos.="<input name=\"valorSubTotalCategoria[]\" size=\"6\" id=\"valorSubTotalCategoria_".$row['id']."\" type=\"text\" DISABLED MAXLENGTH=5 value=\"".$row['']."\"/><br />\n";
							// Exibir os campos dinâmicos
							echo $campos;
						} ?>
					
						<hr width="300px">
						<label>&nbsp;</label>
						<p style="padding-left: 170px">Valor Total = <input name="valortotal" size="4" id="valortotal" type="text"/></p>
					   
						</fieldset>
                      
                      
                      <div align="center">
                      <input id="button1" type="submit" value="Vender" /> 
                      <input id="button2" type="reset"  value="Cancelar venda"/>
					  <input id="button2" type="hidden"  name="numCaixa" value="<?php echo $numCaixa;?>"/>
					  <input id="button2" type="hidden"  name="idUsuario" value="<?php echo $session_idUsuario;?>"/>
                      </div>
</div>					  
                    </form>
			  </div>

            </div>
			
<?php include 'final_inc.php';?>
<?php if ($vendaOk){?>							
	<script language="javascript" type="text/javascript">
		alert('Venda realizada com sucesso!.');
	</script>
<?php }?>
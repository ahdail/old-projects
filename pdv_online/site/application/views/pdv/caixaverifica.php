<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id, numCaixa) {
		if (confirm("Deseja realmente fechar o caixa?")) {
			window.location.href="<?php echo base_url()?>pdv/caixa/fechar/"+id+"/"+numCaixa;
		}
	}
</script>
        <div id="wrapper">
            <div id="content">
	
				<div id="rightnow" style="width:100%" class="margin-left">
				<?php if($row['fechado']=="N"){?>
				<h3 class="reallynow">
					<span>Caixas Abertos</span><br />					
				</h3>
				
				<table>
					<thead>
						<tr>
							<th>Data da Abertura</th>
							<th>Data do fechamento</th>
							<th>Caixa</th>
							<th>Fechado</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td align="center"><?php echo formataData($row['dataAbertura'])?></td>
							<td align="center"><?php echo $row['fechado'] == "N" ? "Em Aberto": formataData($row['dataAbertura'])?></td>
							<td align="center"><?php echo $row['numCaixa']?></td>
							<td align="center"><?php echo $row['fechado'] == "N" ? "Não": "Sim"?></td>
							<td width="40px;">
								<a href="<?php echo base_url()?>pdv/caixa/abrir/<?php echo $row['idUsuario']?>"><img src="<?php echo base_url()?>site/img/icons/application_add.png" title="continuar caixa" /></a>
								<a href="#" onclick="deletar(<?php echo $row['idUsuario']?>, <?php echo $row['numCaixa']?>)"><img src="<?php echo base_url()?>site/img/admin/b_drop.png" /></a>
							</td>
						</tr>
						
					</tbody>

				</table>
				<?php } else {?>
					 <p class="youhave"><strong>Nenhum caixa aberto - </strong>
					 <a href="<?= base_url()?>pdv/caixa/abrir/<? echo $session_idUsuario?>" >Abrir novo caixa <img src="<?php echo base_url()?>site/img/icons/user_add.png" title="continuar caixa" /></a></p>
				<?php } ?>
			</div>

            </div>
<?php
include 'final_inc.php';

?>
<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/usuario/deletar/"+id;
		}
	}
</script>

	<div id="wrapper">
		
		<div id="content">
       			
			<div id="rightnow" style="width:100%" class="margin-left">
				<h3 class="reallynow">
					<span>Usuário - Listagem</span><br />
					<a href="#" onclick="window.location.href='<?php echo base_url()?>pdv/usuario';" style="float:left;" class="add">Novo usuario</a><br />                        
				</h3>
					
				<table>
					<thead>
						<tr>
							<th>Nome do usuario</th>
							<th>Login</th>
							<th>Perfil</th>
							
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usuario as $row) { ?>
						<tr>
							<td align="center"><?php echo $row['usuarioNome']?></td>
							<td align="center"><?php echo $row['login']?></td>
							<td align="center"> <?php echo $row['perfilNome']?></td>
							<td width="40px;" align="center">
								<a href="<?php echo base_url()?>pdv/usuario/detalhar/<?php echo $row['idUsuario']?>"><img src="<?php echo base_url()?>site/img/admin/b_edit.png" /></a>
								<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img src="<?php echo base_url()?>site/img/admin/b_drop.png" /></a><a href="#"><img src="img/icons/page_white_delete.png" /></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					<thead >
						<tr>
							<th colspan="4"> <?php echo $pag;?></th> 
						</tr>
					</thead>

				</table>
					
			</div>
            
		</div>
         
<?php include 'final_inc.php';?>
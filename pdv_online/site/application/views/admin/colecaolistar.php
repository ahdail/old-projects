<?php include 'inicio_inc.php';?>

<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>pdv/usuario/deletar/"+id;
		}
	}
</script>


		
		<div id="content">               
				<div id="box">
                	<h3>Coleção - Listagem</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	
                            	<th><a href="#">Nome da coleção</a></th>                                
                                <th width="60px"><a href="#">Ação</a></th>
                            </tr>
						</thead>
						<tbody>
							<tr>                            	
                            	<td><a href="#">Jennifer Hodes</a></td>                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>                            	
                            	<td><a href="#">Mark Kyrnin</a></td>                            	
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>                            	
                            	<td><a href="#">Virgílio Cezar</a></td>                               
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>                            	
                            	<td><a href="#">Todd Simonides</a></td>                               
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	<td><a href="#">Carol Elihu</a></td>                                
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                                
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	<td><a href="#">Jennifer Hodes</a></td>             
                            	
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Virgílio Cezar</a></td>
                                
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Todd Simonides</a></td>
                                
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	
                            	<td><a href="#">Carol Elihu</a></td>
                                
                                <td><a href="#"><img src="img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
						</tbody>
					</table>
                    <div id="pager">
                    	<< < 1 de 10 > >>
                    
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
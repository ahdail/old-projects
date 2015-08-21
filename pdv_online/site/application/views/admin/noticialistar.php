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
                	<h3>Listagem</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	
                            	<th><a href="#">Titulo</a></th>
                                <th><a href="#">Exibir em</a></th>
                                
                                <th width="60px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
							<tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
                            <tr>
                            	
                            	<td><a href="#">Jennifer Hodes</a></td>
                               
                                <td>General</td>
                                
                                <td><a href="#"><img src="<?php echo base_url()?>site/img/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="<?php echo base_url()?>site/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                            </tr>
						</tbody>
					</table>
                    <div id="pager">
                    	Page <a href="#"><img src="img/icons/arrow_left.gif" width="16" height="16" /></a> 
                    	<input size="1" value="1" type="text" name="page" id="page" /> 
                    	<a href="#"><img src="img/icons/arrow_right.gif" width="16" height="16" /></a>of 42
                    pages | View <select name="view">
                    				<option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                    			</select> 
                    per page | Total <strong>420</strong> records found
                    </div>
                </div>
            </div>            
		</div>
         
<?php include 'final_inc.php';?>
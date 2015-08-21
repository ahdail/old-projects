<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gerenciado de conteudo</title>

	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/demos/demos.css">
	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/themes/base/jquery.ui.datepicker.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/development-bundle/themes/base/jquery.ui.theme.css" type="text/css">

	<!-- Main Controlling Styles -->
	<link href="<?php echo base_url();?>css/admin/main.css" rel="stylesheet" type="text/css" />
	<!-- Blue Theme Styles -->
	<link href="<?php echo base_url();?>themes/blue/styles.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/jquery-1.7.1.js"></script>
	
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
	

	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script src="<?php echo base_url();?>js/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
	
	<script src="<?php echo base_url();?>js/validate/jquery.validate.js"></script>
	
	
	<script src="<?php echo base_url();?>js/datatable/media/js/jquery.dataTables.js"></script>
	
	
	
	
	
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
		</script>
</head>
<body>	
	
		
		

		<table cellpadding="0" cellspacing="0" border="0"  id="example">
			<thead>
				<tr>
					<th>Rendering engine</th>
					<th>Browser</th>
					<th>Platform(s)</th>
					<th>Engine version</th>
					<th>CSS grade</th>
				</tr>
			</thead>
			<tbody>
			<td class="center">A</td>
				</tr>
				<tr class="gradeA">
					<td>Trident</td>
					<td>Internet
						 Explorer 6</td>
					<td>Win 98+</td>
					<td class="center">6</td>
					<td class="center">A</td>
				</tr>
				<tr class="gradeA">
					<td>Trident</td>
					<td>Internet Explorer 7</td>
					<td>Win XP SP2+</td>
					<td class="center">7</td>
					<td class="center">A</td>
				</tr>
				
				
			</tbody>

		</table>
		
		
</body>		
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		
		

		<!-- Referencias a Javascripts externos -->

		<script src="http://www.google.com/jsapi"></script>
		<script>google.load("jquery", "1");</script>

		<!-- Código Javascript interno -->

		<script type='text/javascript'>

		/* Código a ejecutarse tan pronto como la
		    página ha sido cargada por el navegador */

		$(document).ready(function () 
		{
			/* Asociar el evento de clic del botón 'igual'
			    con la lógica del negocio de la aplicación */
			
			$('#igual').click(function() 
			{ 
				procesar();
			});
		});
		
		function procesar()
		{

			$.ajax ({
				
				url: 				'caixa/calcularValorCategoria',								/* URL a invocar asíncronamente */
				type:   			'post',											/* Método utilizado para el requerimiento */
				data: 			$('#formulario').serialize(),		/* Información local a enviarse con el requerimiento */

				/* Que hacer en caso de ser exitoso el requerimiento */

				success: 	function(request, settings)
				{
					/* Cambiar el color del texto a verde */
					
					$('#mensaje').css('color', '#0ab53a');
					
					/* Mostrar un mensaje informando el éxito sucedido */
					
					$('#mensaje').html("Operación realizada exitosamente");
					
					/* Mostrar el resultado obtenido del cálculo solicitado */
					
					$('#resultado').html(request);
				},
				
				/* Que hacer en caso de que sea fallido el requerimiento */
				
				error: 	function(request, settings)
				{
					/* Cambiar el color del texto a rojo */
					
					$('#mensaje').css('color', '#ff0e0e');
					
					/* Mostrar el mensaje de error */
					
					$('#mensaje').html('Error: ' + request.responseText);
					
					/* Limpiar cualquier resultado anterior */
					
					$('#resultado').html('Error');
				}				
			});
		}
		
		</script>

	</head>

	<body>
		<!-- Contenido del documento -->
		
		<div id='pagina'>
			<div id='mensaje'>&nbsp;</div>
			
			<form id='formulario' action='#' method='post'>
				<input type='text' id='operando1' name='operando1' value='' size='4' maxlength='4' />
				
				
				
				<input type='text' id='operando2' name='operando2' value='' size='4' maxlength='4' />
				
				<input type='button' id='igual' value='=' />
				
				<span id='resultado'>&nbsp;</span>
			</form>
		</div>
	</body>
</html>


	
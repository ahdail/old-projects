<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		
		

		<!-- Referencias a Javascripts externos -->

		<script src="http://www.google.com/jsapi"></script>
		<script>google.load("jquery", "1");</script>

		<!-- C�digo Javascript interno -->

		<script type='text/javascript'>

		/* C�digo a ejecutarse tan pronto como la
		    p�gina ha sido cargada por el navegador */

		$(document).ready(function () 
		{
			/* Asociar el evento de clic del bot�n 'igual'
			    con la l�gica del negocio de la aplicaci�n */
			
			$('#igual').click(function() 
			{ 
				procesar();
			});
		});
		
		function procesar()
		{

			$.ajax ({
				
				url: 				'caixa/calcularValorCategoria',								/* URL a invocar as�ncronamente */
				type:   			'post',											/* M�todo utilizado para el requerimiento */
				data: 			$('#formulario').serialize(),		/* Informaci�n local a enviarse con el requerimiento */

				/* Que hacer en caso de ser exitoso el requerimiento */

				success: 	function(request, settings)
				{
					/* Cambiar el color del texto a verde */
					
					$('#mensaje').css('color', '#0ab53a');
					
					/* Mostrar un mensaje informando el �xito sucedido */
					
					$('#mensaje').html("Operaci�n realizada exitosamente");
					
					/* Mostrar el resultado obtenido del c�lculo solicitado */
					
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


	
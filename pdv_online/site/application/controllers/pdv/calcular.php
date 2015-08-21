<?php

/* Indicar el tipo de contenido que tendrá la respuesta */

header('Content-type: text/html');  

try
{
	/* Obtener y sanear los valores de los operadores */
	
	$operando1 = filter_var($_POST['operando1'], FILTER_SANITIZE_NUMBER_FLOAT);
	$operando2 = filter_var($_POST['operando2'], FILTER_SANITIZE_NUMBER_FLOAT);

	/* Verificar que los valores de los operadores correspondan
	    con los tipos esperados */

	if(!filter_var($operando1, FILTER_VALIDATE_FLOAT) ||
	   !filter_var($operando1, FILTER_VALIDATE_FLOAT))
			throw new Exception("Operandos inválidos: [{$operando1}] y [{$operando2}]");

	/* Obtener el valor del operador */

	//$operador = $_POST['operador'];
	$operador = "MU";

	/* Verificar que el operador suministrado sea
	    válido */

		if(!in_array($operador, array('SU', 'RE', 'MU', 'DI')))
			throw new Exception ("Operador inválido: [{$operador}]");

	/* Almacenar resultado, inicialmente desconocido */

	$resultado = 0;

	/* Realizar la operación solicitada */

	switch($operador)
	{
		case 'SU':	$resultado = $operando1 + $operando2;
							break;
		
		case 'RE':	$resultado = $operando1 - $operando2;
							break;
		
		case 'MU':	$resultado = $operando1 * $operando2;
							break;
		
		case 'DI':		/* Verificar si el denominador es cero,
							    en ese caso, la división no puede
							    realizarse */
		
							if ($operando2 == 0)
								throw new Exception ('División por cero');
		
							$resultado = $operando1 / $operando2;
							break;
		
		default:		/* Si ninguna operación se ejecutó significa
							   que el operador era inválido (segunda
							   verificación) */
							
							throw new Exception('Operador desconocido');
							break;
	}
}
catch(Exception $e)			/* La operación produjo un error */
{
	/* Indica al navegador la condición de error */
	
	header("Status: 400 Bad Request", true, 400); 
	
	/* Despliega el mensaje de error para el usuario */
	
	echo $e -> getMessage();
	
	exit(1);
}

/* La operación se realizó exitosamente */

/* Indica al navegador la condición de éxito */

header("Status: 200 OK", true, 200); 

/* Despliega el resultado de la operación para el usuario */

echo number_format($resultado, 4);

exit(0);

?>
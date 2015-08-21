<?php

function converteValor($number)
{
	$valor_convertido = number_format($number,2,'.',',');
	return $valor_convertido;
}

?>
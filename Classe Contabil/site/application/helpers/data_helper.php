<?php
function sqlToDate($data)
{
	$nova_data = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
	return $nova_data;
}

function sqlToDateDiaMes($data)
{
	$diaMesAno = sqlToDate($data);
	$data = explode("/", $diaMesAno);
	$diaMes = $data[0]."/".$data[1];
	return $diaMes;
}

function sqlToDate2($data)
{
	$nova_data = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
	return $nova_data;
}

function sqlToDataHora($data)
{
	$nova_data = explode (" ", $data);
	$hora = $nova_data[1];
	$dataSql = $nova_data[0];
	$dataFormatada = explode ("-", $dataSql);
	return $dataFormatada[2]."/".$dataFormatada[1]."/".$dataFormatada[0].", às ".$hora;
}

?>
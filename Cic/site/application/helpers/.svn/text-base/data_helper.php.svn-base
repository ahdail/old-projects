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
?>
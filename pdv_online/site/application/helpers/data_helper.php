<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

function formataData($horario)
{
	/*Primeiramente temos que definir um nome pra variavel que pega a DATA/HORA do computador.
Vamos dar, o nome de horario.
Primeiramente temos que definir um nome pra variavel que pega a DATA/HORA do computador.
Vamos dar, o nome de horario.*/

//$horario = date(" Y-m-d H:i:s");

/*pronto, agora a DATA/HORA do PC , esta armazenada nesta variavel no formato timestamp (AAAA-MM-DD HH:ii:ss).
agora vamos decompor esta variavel..*/

$month = substr($horario,5,2);
$date = substr($horario,8,2);
$year = substr($horario,0,4);
$hour = substr($horario,11,2);
$minutes = substr($horario,14,2);
$seconds = substr($horario,17,4);

$data = date("D M j G:i:s T Y", mktime($hour,$minutes,$seconds,$month,$date,$year));

/*usei substr para restringir o numero de caracter desejado.
se dermos um echo na $data - teremos no formato padrao a data assim:
Mon Aug 28 17:53:45 Hora oficial do Brasil 2006
mas queremos transformar isto em, Segunda Feira 28 Agosto 17:53, entao criaremos agora a variavel, que pegara no banco de dados o dia da semana.*/

$divi = explode(" ", $data);
$dia_semana_eng = $divi[0];

$mes = $divi[1];
$dia = $divi[2];
$horario = $divi[3];

switch ($dia_semana_eng){
case 'Mon' :
$dia_semana_port = 2;
$text = "Segunda-Feira";
break;

case 'Tue' :
$dia_semana_port = 3;
$text = "Terรงa-Feira";
break;

case 'Wed' :
$dia_semana_port = 4;
$text = "Quarta-Feira";
break;

case 'Thu' :
$dia_semana_port = 5;
$text = "Quinta-Feira";
break;

case 'Fri' :
$dia_semana_port = 6;
$text = "Sexta-Feira";
break;

case 'Sat' :
$text = "Sabado";
$dia_semana_port = 7;
break;

case 'Sun' :
$text = "Domingo";
$dia_semana_port = 1;
break;
}

/*variavel, $dia_semana_pt = busca o valor do dia do banco, e passa para o portugues.
vamos criar tambem uma variavel que "arrume" a data no formato portugues (DD/MM/AAAA)
esta ้ a parte mais facil*/

$diaMesAno = $date."/".$month."/".$year;
$semana = "[".$text."]";
$hora = "as ".$hour.":".$minutes.":".$seconds;

$dataFormatada = $diaMesAno." ".$semana." ".$hora;

return $dataFormatada;

}
?>
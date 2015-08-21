<?php
function retiraAcentuacao($str)
{
	$str = ereg_replace("[АЮБЦ╙]","a",$str);
	$str = ereg_replace("[аюбц]","A",$str);
	$str = ereg_replace("[ИХЙ]","e",$str);
	$str = ereg_replace("[ихй]","E",$str);
	$str = ereg_replace("[СРТУ╨]","o",$str);
	$str = ereg_replace("[срту]","O",$str);
	$str = ereg_replace("[ЗЫШ]","u",$str);
	$str = ereg_replace("[зыш]","U",$str);
	$str = str_replace("Г","c",$str);
	$str = str_replace("г","C",$str);
	$str = ereg_replace(" ","",$str);
	return $str;
	
}
?>
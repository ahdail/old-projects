<?php
function retiraAcentuacao($str)
{
	$str = ereg_replace("[����]","a",$str);
	$str = ereg_replace("[����]","A",$str);
	$str = ereg_replace("[���]","e",$str);
	$str = ereg_replace("[���]","E",$str);
	$str = ereg_replace("[�����]","o",$str);
	$str = ereg_replace("[����]","O",$str);
	$str = ereg_replace("[���]","u",$str);
	$str = ereg_replace("[���]","U",$str);
	$str = str_replace("�","c",$str);
	$str = str_replace("�","C",$str);
	$str = ereg_replace(" ","",$str);
	return $str;
	
}
?>
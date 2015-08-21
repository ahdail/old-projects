<?php
function arrobaImg($email)
{
	$emailArroba = str_replace("@", "<img src=\"".base_url()."site/img/arroba.gif\" alt=\"@\" border=\"0\" />", $email);
	return $emailArroba;
}
?>
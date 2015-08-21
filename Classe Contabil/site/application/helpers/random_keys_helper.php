<?
function randomKeys($length)
{
	$patern = "1234567890abcdefghijklmnopqrstuvwxyz";
	
	for ($i=0; $i<$length; $i++) {
		if (isset($key)) {
			$key .= $patern{rand(0,35)};
		} else {
			$key = $patern{rand(0,35)};
		}
	}
	
	return $key;
}
?>
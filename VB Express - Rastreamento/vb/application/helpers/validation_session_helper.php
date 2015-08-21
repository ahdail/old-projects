<?php
// Verifica se o usuário está autentiado na session
function session_validation($session_email)
{
	if (!$_SESSION['session_email']){
		//return False;
		//redirect('login', 'location');
	}
}
?>
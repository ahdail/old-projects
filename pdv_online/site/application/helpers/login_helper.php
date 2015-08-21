<?php
function checkLogin($email) {
	// Checa se o usu�rio est� logado, caso n�o esteja devolve pra p�gina de login
	$CI =& get_instance();
	
	if (!$email) {
		$backTo = array('backTo' => uri_string());
		$CI->session->set_userdata($backTo);
		redirect('pdv/login', 'location');
	}
}
function checkSessao($perfil) {
	// Checa se o usu�rio est� logado, caso n�o esteja devolve pra p�gina de login
	$CI =& get_instance();
	
	$session_login = $CI->session->userdata('login');
	if (!$session_login) {
		$backTo = array('backTo' => uri_string());
		$CI->session->set_userdata($backTo);
		redirect('login', 'location');
	}
	
	$codigos = $CI->session->userdata('codigos');
	if (!$codigos[$perfil]) {
		echo "Voc� n�o tem permiss�o para acessar este conte�do";
		die();
	}
	
}

function isUsuarioValido($id) {
	$CI =& get_instance();
	
	$CI->load->model('usuariomodel',"UsuarioModel");
	
	$usuario = $CI->UsuarioModel->detalhar($id);
	
	return ($usuario['nome'] && $usuario['estado'] && $usuario['cidade'] && $usuario['idOcupacao']);
}

?>
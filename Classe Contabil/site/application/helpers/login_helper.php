<?php
function checkLogin($email) {
	// Checa se o usuário está logado, caso não esteja devolve pra página de login
	$CI =& get_instance();
	
	if (!$email) {
		$backTo = array('backTo' => uri_string());
		$CI->session->set_userdata($backTo);
		redirect('login', 'location');
	}
}
function checkSessao($perfil) {
	// Checa se o usuário está logado, caso não esteja devolve pra página de login
	$CI =& get_instance();
	
	$session_login = $CI->session->userdata('login');
	if (!$session_login) {
		$backTo = array('backTo' => uri_string());
		$CI->session->set_userdata($backTo);
		redirect('login', 'location');
	}
	
	$codigos = $CI->session->userdata('codigos');
	if (!$codigos[$perfil]) {
		echo "Você não tem permissão para acessar este conteúdo";
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
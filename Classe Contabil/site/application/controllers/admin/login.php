<?php
class Login extends Controller {

	function __construct() 
	{
		parent::Controller();	
		$this->load->library (array ('form_validation', 'session'));
		$this->load->helper(array('form', 'url'));
		$this->load->model('admin/usuariomodel',"UsuarioModel");
	}
	
	function index() 
	{
		$this->load->view('admin/login');
	}
	
	function validar()
	{
		$usuario = array(
			'login' => $this->input->post('login'),
			'senha' => md5($this->input->post('senha'))
		);
		$resultado = $this->UsuarioModel->validaLogin($usuario);
		if ($resultado){
			$row = $this->UsuarioModel->validaLogin($usuario);
			$row2 = $this->UsuarioModel->exibirPerfil($row['idPerfil']);
			
			// Cria o array de codigos
			foreach ($row2 as $valor) {
				$codigos[$valor['codigo']]  = true;
			}

			$sessionDados = array('nomeAdm' => $row['nome'],'login' => $row['login'], 'codigos' => $codigos);
			$this->session->set_userdata($sessionDados);
			$this->load->view('admin/index');
		} else {
			$erro['erro'] = "erro";
			$this->load->view('admin/login',$erro);
		}
	}
}
?>
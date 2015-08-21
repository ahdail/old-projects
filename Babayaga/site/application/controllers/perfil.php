<?php
class Perfil extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'data'));
		$this->load->library(array('session'));
		$this->load->model('admin/perfilbabayagamodel',"PerfilBabayagaModel");
	}
	
	function index() 
	{
		$var['babayaga'] = $this->PerfilBabayagaModel->ultimosPerfis();
		$var['todosPerfis'] = $this->PerfilBabayagaModel->todosPerfis();
		$this->load->view('perfil', $var);
	}
	
	function ver($id) 
	{		
		$var['babayaga'] = $this->PerfilBabayagaModel->detalhar($id);
		$var['todosPerfis'] = $this->PerfilBabayagaModel->todosPerfis();
		$this->load->view('perfil', $var);
	}
}
?>
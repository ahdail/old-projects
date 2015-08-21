<?php
class Empresa extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
		$this->load->model('admin/quemsomosmodel',"QuemSomosModel");
	}
	function index() 
	{
		$var['empresa'] = $this->QuemSomosModel->exibirQuemSomosSite();
		$this->load->view('empresa', $var);
	}
}
?>
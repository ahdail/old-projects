<?php
class Votar extends Controller {

	function __construct() 
	{
		parent::Controller();	
		$this->load->library(array ('form_validation', 'session', 'pagination'));
		$this->load->model('votarModel',"VotarModel");
	}

	function index($idResposta,$idPergunta) 
	{
		$this->VotarModel->insert($idResposta,$idPergunta);
		//$this->load->view('votar');
	}
	
}
?>
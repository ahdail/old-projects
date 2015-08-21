<?php
class Votar extends Controller
{
	function index($idResposta,$idPergunta) 
	{
		$this->load->model('votarModel',"VotarModel");
		$this->VotarModel->insert($idResposta,$idPergunta);
		
		$this->load->view('votar');
	}
}
?>
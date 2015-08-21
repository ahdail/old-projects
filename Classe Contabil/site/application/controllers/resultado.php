<?php
class Resultado extends Controller {

	function __construct() 
	{
		parent::Controller();	
		$this->load->library(array ('form_validation', 'pagination'));
		$this->load->model('resultadomodel',"ResultadoModel");
	}

	function index($idPergunta) 
	{
		$var['total']= $this->ResultadoModel->totalPergunta($idPergunta);
		$var['respostas'] = $this->ResultadoModel->totalResposta($idPergunta);
		
		$this->load->view('resultado',$var);
	}
	
}
?>
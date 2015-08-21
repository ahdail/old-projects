<?php
class Dica extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'data'));
		$this->load->library(array('session'));
		$this->load->model('dicamodel',"DicaModel");
	}

	function index() 
	{
		$var['dica'] = $this->DicaModel->ultimas5();
		$var['ultima'] = $this->DicaModel->ultimaNoticia();
		$this->load->view('dica', $var);
	}
	
	function ver($id=0) 
	{
		$var['dica'] = $this->DicaModel->ultimas5();		
		$var['atual'] = $this->DicaModel->detalhar($id);
		$this->load->view('dica', $var);
	}
	
}
?>
<?php
class Colecao extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
		$this->load->model('admin/colecaomodel',"ColecaoModel");
		$this->load->model('admin/colecaofotomodel',"ColecaoFotoModel");
	}
	function index() 
	{
		$var['colecoes'] = $this->ColecaoModel->todasColecoes();
		$var['colecoesatual']= $this->ColecaoModel->colecaoAtual();
		
		$var['fotoscolecaoatual']= $this->ColecaoModel->colecaoAtualFotos($var['colecoesatual']['id']);
		
		$this->load->view('colecao', $var);
	}
	
	function ver($id)
	{

		if ($id) {
	    	$var['colecao'] = $this->ColecaoModel->detalhar($id);
		}

		$var['fotoscolecao']= $this->ColecaoModel->colecaoAtualFotos($var['colecao']['id']);

		$var['colecoes'] = $this->ColecaoModel->todasColecoes();
		
		$this->load->view('colecao', $var);
	
	}
	
}
?>
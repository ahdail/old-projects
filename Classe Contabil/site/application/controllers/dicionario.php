<?php
class Dicionario extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('dicionariomodel',"DicionarioModel");
		
		$this->load->helper(array('highlight', 'string'));
		$this->load->library(array('form_validation', 'funcoes','session'));
	}

	function index() 
	{
		$var['dicionario'] = $this->DicionarioModel->exibir("A");
		$this->render('dicionario', $var);
	}
	
	function letra($letra) 
	{
        // Carregar os dados da Editora Fortes no Portal
		$var['dicionario'] = $this->DicionarioModel->buscar($letra);
        $this->render('dicionario', $var);
	}
	
	function detalhar($idPalavra) {
		$highlight = $this->input->post('highlight');

		$var['row'] = $this->DicionarioModel->detalhar($idPalavra);
		$var['row']['significado'] = highlight($var['row']['significado'], $highlight);
		
		echo $this->load->view('dicionarioDetalhe', $var, true);
	}
	
	function buscar() 
	{	
		$search = $this->input->post('search');
		
		if (!$search) {
			$var['dicionario'] = $this->DicionarioModel->exibir("A");
		} else {
	        $var['dicionario'] = $this->DicionarioModel->buscarDic($search);
		}

		$this->render('dicionario', $var);
	}
	
}
?>
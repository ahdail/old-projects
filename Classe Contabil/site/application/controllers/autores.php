<?php
class Autores extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('autoresmodel',"AutoresModel");
		$this->load->helper(array('highlight', 'string', 'login', 'tag_dicionario'));
		$this->load->library(array ('form_validation', 'funcoes','session', 'enviarmail', 'pagination'));
	}

	
	function index() 
	{
		$var['autores'] = $this->AutoresModel->buscar("A");
		$var['letra'] = "A";
		$this->render('autores', $var);
	}
	
	function buscar() 
	{	
		$search = $this->input->post('search');
		
		if (!$search) {
			$var['autores'] = $this->AutoresModel->exibir("A");
		} else {
	        $var['autores'] = $this->AutoresModel->buscarAutor($search);
		}
		$this->render('autores', $var);
	}
	
	function letra($letra) 
	{
        $var['autores'] = $this->AutoresModel->buscar($letra);
        $var['letra'] = $letra;
        $this->render('autores', $var);
	}

	function verAutor($id) 
	{
		$var['autor'] = $this->AutoresModel->verAutor($id);
		$var['nomeAutor'] = $var['autor'][0]['nome'];
		$var['qtdArtigos'] =  $this->AutoresModel->qtdArtigo($id);
		$this->render('autorClasse', $var);
	}
	
}
?>
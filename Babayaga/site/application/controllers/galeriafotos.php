<?php
class GaleriaFotos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('session'));
		$this->load->model('admin/galeriamodel',"GaleriaModel");
		$this->load->model('admin/galeriafotomodel',"GaleriaFotoModel");
	}
	function index() 
	{
		$var['galerias'] = $this->GaleriaModel->todasGalerias();
		$var['galeriasatual']= $this->GaleriaModel->galeriaAtual();
		
		$var['fotosgaleriaatual']= $this->GaleriaModel->galeriaAtualFotos($var['galeriasatual']['id']);
		
		$this->load->view('galeriafotos', $var);
	}
	
	function ver($id)
	{

		if ($id) {
	    	$var['galeria'] = $this->GaleriaModel->detalhar($id);
		}

		$var['fotosgaleria']= $this->GaleriaModel->galeriaAtualFotos($var['galeria']['id']);
		
		$var['galerias'] = $this->GaleriaModel->todasGalerias();
		
		$this->load->view('galeriafotos', $var);
	
	}
}
?>
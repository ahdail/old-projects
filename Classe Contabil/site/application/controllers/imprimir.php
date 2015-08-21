<?php
class Imprimir extends Controller
{
	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('imprimirModel',"ImprimirModel");
	}
	
	function noticia($id)
	{
		$imprimir['imprimir'] = $this->ImprimirModel->imprimirNoticia($id);
		$imprimir['secao'] = "not";
		$this->load->view('imprimir', $imprimir);
	}
	
	function artigo($id)
	{
		$imprimir['imprimir'] = $this->ImprimirModel->imprimirArtigo($id);
		$imprimir['secao'] = "art";
		$this->load->view('imprimir', $imprimir);
	}
	
	function juizodiario($id)
	{
		$imprimir['imprimir'] = $this->ImprimirModel->imprimirJuizo($id);
		$imprimir['secao'] = "juizo";
		$this->load->view('imprimir', $imprimir);
	}
	
	function direito($id)
	{
		$imprimir['imprimir'] = $this->ImprimirModel->imprimirDireito($id);
		$imprimir['secao'] = "direito";
		$this->load->view('imprimir', $imprimir);
	}

}
?>
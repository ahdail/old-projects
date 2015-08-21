<?php

class Home extends Controller {
	private $vet_dados = array();
	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->vet_dados["head"] 	 = $this->parser->parse("head", $this->vet_dados, TRUE);
		$this->vet_dados["menu"] 	 = $this->parser->parse("menu", $this->vet_dados, TRUE);
		$this->vet_dados["conteudo"] = $this->parser->parse("conteudo", $this->vet_dados, TRUE);
		//$this->vet_dados["conteudo"] = $this->parser->parse("listagem", $this->vet_dados, TRUE);
		$this->vet_dados["rodape"]   = $this->parser->parse("rodape", $this->vet_dados, TRUE);
		
		$this->parser->parse("template", $this->vet_dados);
	}
}

?>
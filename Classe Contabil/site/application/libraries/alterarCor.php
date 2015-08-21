<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Arquivo de funcoes FORTES INFORMATICA Versao 1.0
class alterarCor {	
	private $var1;
	private $var2;
	private $atual;
	
	function __construct($cores)
	{
		$this->var1 = $cores[0];
		$this->var2 = $cores[1];
	}
	
	function pegar ()
	{
		if ($this->atual == $this->var1) {
			$this->atual = $this->var2;
		} else {
			$this->atual = $this->var1;
		}
		return $this->atual;
	}
}
?>
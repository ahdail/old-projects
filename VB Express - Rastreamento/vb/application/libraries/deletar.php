<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class deletar
{

	private $caminho;

	function deletar ($caminho)
	{
		$this->caminho = $caminho;
		unlink($this->caminho = $caminho);
	}

}
?>
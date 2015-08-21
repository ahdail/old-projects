<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Auditoria
{
	private $CI;
	private $nomeSession; 
	private $loginSession;
	private $idSession; 
	private $mensagem;

	function __construct() {
		$this->CI = get_instance();
		$this->CI->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	function carregar ($nomeSession, $loginSession, $idSession, $mensagem)
	{
		$this->nomeSession 	= $nomeSession; 
		$this->loginSession = $loginSession;
		$this->idSession 	= $idSession; 
		$this->mensagem 	= $mensagem;
	}
	
	function gravar() 
	{
		if ($this->idSession){
			$log = "($this->nomeSession) $edit $this->mensagem ($this->loginSession) do id ($this->idSession)";
		} else {
			$log = "($this->nomeSession) $add $this->mensagem  ($this->loginSession)";
		}
		
		$auditoria = array(
			'log' => $log, 
			'dataHora' => date("Y-m-d H:i:s")
		);
		$this->CI->AuditoriaModel->insert($auditoria);
	}
}
?>
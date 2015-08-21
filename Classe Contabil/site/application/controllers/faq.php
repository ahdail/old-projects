<?php
class Faq extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
			
		$this->load->helper(array('login', 'tag_dicionario'));
		$this->load->library(array ('funcoes', 'pagination','session'));
		$this->load->model('admin/faqmodel',"FaqModel");
	}
	
	function index()
	{
		$var['faq'] = $this->FaqModel->exibirfaqPortal();
		$this->render('faq', $var);
	}	
	
}
?>
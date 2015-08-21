<?php
class Evento extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login', 'date','data'));
		$this->load->library(array('session','funcoes', 'pagination'));
		$this->load->model('admin/eventoModel',"EventoModel");
		$this->load->model('admin/eventofotomodel',"EventoFotoModel");
	}
	
	function index($year = null, $month = null)
	{
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		if (!$day) {
			$day = date('d');
		}
	
		$var['eventos'] = $this->EventoModel->ultimos10();
		$var['ultimo'] = $this->EventoModel->ultimosEventos();		
		$var['fotosultimoevento']= $this->EventoFotoModel->todasFotosEvento($var['ultimo']['id']);

		$var['calendar'] = $this->EventoModel->generate($year, $month);

		$this->load->view('evento', $var);
	}

	
	function show($data) 
	{
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		if (!$day) {
			$day = date('d');
		}
		
		$var['eventos'] = $this->EventoModel->ultimos10();	
		$var['atual'] = $this->EventoModel->detalharData($data);

		$var['fotosevento']= $this->EventoFotoModel->todasFotosEvento($var['atual']['id']);
		
		$var['calendar'] = $this->EventoModel->generate($year, $month);

		$this->load->view('evento', $var);
	}
	
	function preview($year = null, $month = null) 
	{
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		if (!$day) {
			$day = date('d');
		}
	
		$var['eventos'] = $this->EventoModel->ultimos10();
		$var['ultimo'] = $this->EventoModel->ultimosEventos();		
		$var['fotosultimoevento']= $this->EventoFotoModel->todasFotosEvento($var['ultimo']['id']);

		$var['calendar'] = $this->EventoModel->generate($year, $month);

		$this->load->view('evento', $var);
	}
	
	
	
}
?>
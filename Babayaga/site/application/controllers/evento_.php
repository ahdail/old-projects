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
	
	function ver($id = 0) 
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
		
		$var['eventos'] = $this->EventoModel->ultimos10();;		
		$var['atual'] = $this->EventoModel->detalhar($id);		
		$var['fotosevento']= $this->EventoFotoModel->todasFotosEvento($var['atual']['id']);

		$dataseventos = $var['dataseventos'] = $this->EventoModel->datasEventos();		
		foreach ($dataseventos as $row) {
			$d = explode ("-", $row['data']);			
			$data = array($d[2] => base_url().'evento/show/'.$d[0].'-'.$d[1].'-'.$d[2]);
		}
		
		$var['calendar'] = $this->calendar->generate($year, $month, $data);

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
	
	
	
}
?>
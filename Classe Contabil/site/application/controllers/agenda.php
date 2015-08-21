<?php
class Agenda extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('agendamodel',"AgendaModel");
		$this->load->library(array ('funcoes', 'pagination'));
	}

	function index()
	{
		$this->listar();
	}

	function evento($id)
	{
		$var = $this->AgendaModel->detalhar($id);
		$var['url']  = "agenda";
		$this->render('evento',$var);
	}

	function listar($data=false)
	{
       $var['meses'] =  $this->AgendaModel->exibir($data);
       $this->render('agenda', $var);
	}

	function exibirCalendario ()
	{
		// Pega os parametros GET
		$this->load->helper('get_request');
		$request = getRequests();

		// Popula os parametros e instancia a classe do calendairo
		$param = array(
			"year" => $request['yearID'],
			"month" => $request['monthID'],
			"GMTDiff" => "none"
		);
		$this->load->library('calendariophp/activecalendar', $param);

		// Habilita a navegação por meses
		$this->activecalendar->enableMonthNav(
			base_url()."agenda/exibirCalendario/",
			"<img src='".base_url()."site/img/calendariophp/arrow_left.gif' border='0'>",
			"<img src='".base_url()."site/img/calendariophp/arrow_right.gif' border='0'>"
		);

		// Pega o ano e mes passados ou os atuais
		$ano = ($request['yearID']) ? $request['yearID'] : date('Y');
		$mes = ($request['monthID']) ? $request['monthID'] :  date('m');
		// Cria o link para os dias com evento
		$eventos = $this->AgendaModel->listarEventos($mes,$ano);
		foreach($eventos as $eventoRow) {
			// Cria o link que será usado no calendario
		    $link = base_url()."agenda/listar/{$eventoRow['data']}\" target='_parent'";
		    // Cria o evento no calendario
		    list($a, $m, $d) = split("-", $eventoRow['data']);
		    $this->activecalendar->setEvent($a,$m,$d,'event',$link);
		}
		$this->load->view('agendaCalendario');
	}

}

?>
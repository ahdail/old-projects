<?php
class Agenda extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('form', 'url','date','data'));
		$this->load->library(array ('funcoes', 'pagination') );
		$this->load->model('agendamodel',"AgendaModel");
		$this->load->model('conteudomodel', "ConteudoModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
		$this->load->helper('get_request');
	}

	function index()
	{
		$this->listar();
	}
	
	function evento($id)
	{
		$var = $this->AgendaModel->detalhar($id);
		
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$var['url']  = "agenda";
		$this->load->view('evento',$var);
	}
	
	function listar($data=false) 
	{
        $var['meses'] =  $this->AgendaModel->exibir($data);
        
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$var['bannerExclusivo']  = $this->BannerModel->exibirBannerExclusivo();
        $this->load->view('agenda',$var);
	}
	
	function exibirCalendario ()
	{
		// Pega os parametros GET
		
		$request = getRequests();
		
		// Popula os parametros e instancia a classe do calendairo
		/*
		$param = array(
			"year" => $request['yearID'],
			"month" => $request['monthID'],
			"GMTDiff" => "none"
		);
		*/
		$param = array(
			"year" => date("Y"),
			"month" => date("m"),
			"GMTDiff" => "none"
		);
		$this->load->library('calendariophp/activecalendar', $param);

		// Habilita a navegação por meses
		$this->activecalendar->enableMonthNav(
			base_url()."agenda/exibirCalendario/",
			"<!--<img src='".base_url()."site/img/calendariophp/arrow_left.gif' border='0'>-->",
			"<!--<img src='".base_url()."site/img/calendariophp/arrow_right.gif' border='0'>-->"
		);
		$request['yearID'] = date("Y");
		$request['monthID'] = date("m");
		// Pega o ano e mes passados ou os atuais
		$ano = ($request['yearID']) ? $request['yearID'] : date('Y');
		$mes = ($request['monthID']) ? $request['monthID'] :  date('m');
		//$ano = date("Y");
		//$mes = date("m");
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
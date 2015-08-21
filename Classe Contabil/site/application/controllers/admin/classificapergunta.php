<?php 
class Classificapergunta extends Controller
{
	function __construct() {
		parent::__construct();

		$this->load->helper('data');
		$this->load->model('admin/classificacaoperguntamodel', 'cla_pergunta_model');
		$this->load->library('alterarCor', array('cor1', 'cor2'));
	}
	
	function index($data=false) {
		if ($this->input->post('data')) {
			$data = sqlToDate2($this->input->post('data'));
		}
		
		if ($data) {
			$var['qtdPerguntas'] = $this->cla_pergunta_model->getPerguntasTotal($data);
			$var['perguntas'] = $this->cla_pergunta_model->getPerguntas($data);
			$var['temas'] = $this->cla_pergunta_model->getTemas();
			$var['data'] = $data;
		} else {
			$var['qtdPerguntas'] = 0;	
		}
		
		$this->load->view('admin/classificapergunta', $var);
	}
	
	// Retorna a próxima pergunta para colocar no fim da listagem
	function exibirProximaPergunta() {
		// Pega a proxima pergunta em uma data
		$data = $this->input->post('data');
		$var['pergunta'] = $this->cla_pergunta_model->getProximaPergunta($data);
		
		// Se ainda houver alguma pergunta, carrega a view
		if ($var['pergunta']) {
			$var['cor'] = ($this->input->post('cor') == 1) ? "cor2" : "cor1";
			$var['temas'] = $this->cla_pergunta_model->getTemas();
			
			echo $this->load->view('admin/classificaperguntaproxima', $var, true);
		}
		
	}
	
	function atualizarTema() {
		$idPergunta = $this->input->post('idPergunta');
		$idTema = $this->input->post('idTema');
		
		$this->cla_pergunta_model->setTema($idPergunta, $idTema);
	}
	
	function exibirCalendario() {
		// Pega os parametros GET
		$this->load->helper('get_request');
		$request = getRequests();
		
		// Pega o ano e mes passados ou os ultimos com registros
		if ($request['yearID'] and $request['monthID']) {
			$ano = $request['yearID'];
			$mes = $request['monthID'];
		} else {
			$data = $this->cla_pergunta_model->getUltimaPergunta();
			$ano = $data['ano'];
			$mes = $data['mes'];
		}
		
		// Popula os parametros e instancia a classe do calendairo
		$param = array(
			"year" => $ano,
			"month" => $mes,
			"GMTDiff" => "none"
		);
		$this->load->library('calendariophp/activecalendar', $param);

		// Habilita a navegação por meses
		$this->activecalendar->enableMonthNav(
			base_url()."admin/classificapergunta/exibirCalendario/",
			"<img src='".base_url()."site/img/calendariophp/arrow_left.gif' border='0'>",
			"<img src='".base_url()."site/img/calendariophp/arrow_right.gif' border='0'>"
		);
		
		// Cria o link para os dias com evento
		$eventos = $this->cla_pergunta_model->listarPerguntas($mes,$ano);
		
		foreach($eventos as $eventoRow) {
			// Cria o link que será usado no calendario
		    list($a, $m, $d) = split("-", substr($eventoRow['data'], 0, 10));
		    $link = base_url()."admin/classificapergunta/index/{$a}-{$m}-{$d}\" target='_parent'";

		    // Cria o evento no calendario
		    $this->activecalendar->setEvent($a,$m,$d,'event',$link);
		}
		$this->load->view('admin/classificacaoperguntaCalendario');
	}
	
	
}

?>
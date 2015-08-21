<?php
class Pesquisa extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination'));
		$this->load->helper('date');
		// Instвnciando as Classe do Model
		$this->load->model('admin/pesquisamodel',"PesquisaModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	

	/**    TUDO SOBRE PERGUNTA    */
	
	function pesquisaListar($start = 0) 
	{
    	$config = array(
    		'base_url' => site_url('/admin/pesquisa/pesquisaListar/'),
    		'per_page' => 10,
    		'total_rows' => $this->PesquisaModel->pesquisaGetTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Ъltima'
    	);
                
        $query = $this->PesquisaModel->pesquisaExibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginaзгo
        $var['pag'] = $this->pagination->create_links();
		
        $var['pesquisa'] = $query->result_array();
		$this->load->view('admin/pesquisalistar',$var);
	}
	// Marca o notнcia como: Exibir como Destaque 
	function pesquisaDetalhar($id = 0)
	{
		if ($id) {
	    	$var['row'] = $this->PesquisaModel->pesquisaDetalhar($id);
		} 
		$this->load->view('admin/pesquisamanter',$var);
	}
	
	function pesquisaDeletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [PESQUISA] Deletou pergunta do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->PesquisaModel->pesquisaDeletar($id);
		$this->pesquisaListar();
	}
	
	function pesquisaExibe($id,$exibe)
	{
		$var = array('exibir' => $exibe);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [ENQUETE] Alterou pergunta do id ($id) para exibr ($exibe)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->PesquisaModel->pesquisaExibe($id,$var);
		$this->pesquisaListar();
	}
	
	function pesquisaManter()
	{	
		$this->form_validation->set_rules('pesquisa', 'Pesquisa', 'required');
		
		// Traz todos os dados do form para Ediзгo
		$varPost['row'] = $_POST;
		// Carregar os dados passado atravйs do formulбrio
		$var = array(
			'pesquisa' => $this->input->post('pesquisa'),
			'exibir' => $this->input->post('exibir'),
			'qtdPerguntas' => $this->input->post('qtdPerguntas')
		);
		
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/pesquisaManter',$varPost);
		} else {
			$pesquisa = $this->input->post('pesquisa');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){
				// Grava o Log 
				$log = "($session_login) [PESQUISA] Editou  Pesquisa da Pergunta ($Pergunta) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->PesquisaModel->pesquisaUpdate($id,$var);
			} else {
				// Grava o Log 
				$log  = "($session_login) [PESQUISA] Adicionou  Pesquisa do tнtulo ($titulo)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->PesquisaModel->pesquisaInsert($var);
				$this->AuditoriaModel->insert($auditoria);
			} 
			$this->pesquisaListar();
		}		
	}
	
	/**    TUDO SOBRE PERGUNTA    */
	
	function pesquisaPerguntaListar($idPesquisa) 
	{
                
		$var['pesquisaPergunta'] = $this->PesquisaModel->pesquisaPerguntaExibir($idPesquisa);
        $var['pesquisa'] = $this->PesquisaModel->todasPesquisas();
		$var['idPesquisa'] = $idPesquisa;
		$this->load->view('admin/pesquisaperguntalistar',$var);
		
	}
	
	
	function todasPesquisas()
	{
		$var['pesquisa'] = $this->PesquisaModel->todasPesquisas();
		$this->load->view('admin/pesquisaperguntalistar',$var);
	}
	
	
	
	function pesquisaPerguntaDetalhar($id,$idPesquisa)
	{
		if ($id) {
	    	$var['row'] = $this->PesquisaModel->pesquisaPerguntaDetalhar($id);
		} 
		$var['idPesquisa'] = $idPesquisa;
		$var['pesquisa'] = $this->PesquisaModel->todasPesquisas();
		$this->load->view('admin/pesquisaperguntamanter',$var);
	}
	
	function pesquisaPerguntaDeletar($id,$idPesquisa)
	{
		
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [PESQUISA] Deletou resposta do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->PesquisaModel->pesquisaPerguntaDeletar($id);
		$this->respostaListar();
	}
	
	function pesquisaPerguntaManter()
	{	
		$this->form_validation->set_rules('pergunta', 'Pergunta', 'required');
		
		// Traz todos os dados do form para Ediзгo
		$varPost['row'] = $_POST;
		// Carregar os dados passado atravйs do formulбrio
		$var = array(
			'pergunta' => $this->input->post('pergunta'),
			'tipo' => $this->input->post('tipo'),
			'op1' => $this->input->post('op1'),
			'op2' => $this->input->post('op2'),
			'op3' => $this->input->post('op3'),
			'op4' => $this->input->post('op4'),
			'op5' => $this->input->post('op5'),
			'comentario' => $this->input->post('comentario'),
			'tipoComentario' => $this->input->post('tipoComentario'),
			'idPesquisa' => $this->input->post('idPesquisa')
		);
		// Apуs a validaзгo dos campos, e dependendo do resultado, й feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/pesquisaperguntamanter',$varPost);
		} else {
			$pergunta = $this->input->post('pergunta');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){
				// Grava o Log 
				$log = "($session_login) [PESQUISA] Editou  Pesquisa da resposta ($resposta) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->PesquisaModel->pesquisaperguntaUpdate($id,$var);
			} else {
				// Grava o Log 
				$log  = "($session_login) [ENQUETE] Adicionou  Resposta ($resposta)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->PesquisaModel->pesquisaPerguntaInsert($var);
				$this->AuditoriaModel->insert($auditoria);
			} 
			$this->pesquisaPerguntaListar($this->input->post('idPesquisa'));
		}		
	}
	
	/** Relбtorios */
	
	function relatorio($post=null)
	{
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		// Pesquisas
		$var['pesquisas'] = $this->PesquisaModel->todasPesquisas();
		// Cargos
		$var['cargos'] = $this->CargoModel->getAll();
		// Estados
		$var['estados'] = $this->EstadoModel->getAll();
		// POST
		$var['row'] = $post;
		
		
		// Vamos levar pra view ?
		$this->load->view('admin/pesquisa_relatorio',$var);
	}
	
	function montaRelatorio()
	{
		$this->form_validation->set_rules('idPesquisa', 'Pesquisa', 'required');
		$this->form_validation->set_rules('idEstado', 'Estado', 'required');
		$this->form_validation->set_rules('idCargos', 'Cargos', 'required');
		
		if ($this->form_validation->run () == FALSE) {
			$this->relatorio($_POST); 
		} else {
			$dados = array (
				"idPesquisa" => $this->input->post('idPesquisa'),
				"idEstado" => $this->input->post('idEstado'),
				"idCargos" => $this->input->post('idCargos'), 
			);
			
			$var['relatorio'] = $this->PesquisaModel->getRelatorio($dados);
			
			// Exibe o relatуrio
			$this->load->view('admin/pesquisa_montar_relatorio',$var);
		}
	}
	
}
?>
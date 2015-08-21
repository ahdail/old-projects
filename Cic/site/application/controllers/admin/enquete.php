<?php
class Enquete extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination'));
		$this->load->helper('date');
		// Instânciando as Classe do Model
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	
	

	/**    TUDO SOBRE PERGUNTA    */
	
	function perguntaListar($start = 0) 
	{
    	$config = array(
    		'base_url' => site_url('/admin/enquete/perguntaListar/'),
    		'per_page' => 10,
    		'total_rows' => $this->EnqueteModel->perguntaGetTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
                
        $query = $this->EnqueteModel->perguntaExibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginação
        $enquetePergunta['pag'] = $this->pagination->create_links();
		
        $enquetePergunta['enquetePergunta'] = $query->result_array();
		$this->load->view('admin/enquetePerguntalistar',$enquetePergunta);
	}
	// Marca o notícia como: Exibir como Destaque 
	function perguntaDetalhar($id)
	{
		if ($id) {
	    	$enquetePergunta['row'] = $this->EnqueteModel->perguntaDetalhar($id);
		} 
		$this->load->view('admin/enquetePerguntaManter',$enquetePergunta);
	}
	
	function perguntaDeletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [ENQUETE] Deletou pergunta do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->EnqueteModel->perguntaDeletar($id);
		Enquete::perguntalistar();
	}
	
	function perguntaExibe($id,$exibe)
	{
		$enquetePergunta = array('exibir' => $exibe);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [ENQUETE] Alterou pergunta do id ($id) para exibr ($exibe)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->EnqueteModel->perguntaExibe($id,$enquetePergunta);
		Enquete::perguntaListar();
	}
	
	function perguntaManter()
	{	
		$this->form_validation->set_rules('pergunta', 'Pergunta', 'required');
		
		// Traz todos os dados do form para Edição
		$enquetePerguntaPost['row'] = $_POST;
		// Carregar os dados passado através do formulário
		$enquetePergunta = array(
			'pergunta' => $this->input->post('pergunta'),
			'exibir' => $this->input->post('exibir')
		);
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/enquetePerguntaManter',$enquetePerguntaPost);
		} else {
			$pergunta = $this->input->post('pergunta');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){
				// Grava o Log 
				$log = "($session_login) [ENQUETE] Editou  Enquete da Pergunta ($Pergunta) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->EnqueteModel->perguntaUpdate($id,$enquetePergunta);
			} else {
				// Grava o Log 
				$log  = "($session_login) [ARTIGO] Adicionou  Artigo do título ($titulo)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->EnqueteModel->perguntaInsert($enquetePergunta);
				$this->AuditoriaModel->insert($auditoria);
			} 
			Enquete::perguntaListar();
		}		
	}
	
	/**    TUDO SOBRE RESPOSTA    */
	
	function respostaListar($idPergunta) 
	{
                
		$enqueteResposta['enqueteResposta'] = $this->EnqueteModel->respostaExibir($idPergunta);
        $enqueteResposta['pergunta'] = $this->EnqueteModel->todasPerguntas();
		$enqueteResposta['idPergunta'] = $idPergunta;
		$this->load->view('admin/enqueteRespostalistar',$enqueteResposta);
		
	}
	
	
	function todasPerguntas()
	{
		$enqueteResposta['pergunta'] = $this->EnqueteModel->todasPerguntas();
		$this->load->view('admin/enqueteRespostaListar',$enqueteResposta);
	}
	
	
	
	function respostaDetalhar($id,$idPergunta)
	{
		if ($id) {
	    	$enqueteResposta['row'] = $this->EnqueteModel->respostaDetalhar($id);
		} 
		$enqueteResposta['idPergunta'] = $idPergunta;
		$enqueteResposta['enqueteResposta'] = $this->EnqueteModel->todasPerguntas();
		$this->load->view('admin/enqueteRespostaManter',$enqueteResposta);
	}
	
	function respostaDeletar($id,$idPergunta)
	{
		
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log  = "($session_login) [ENQUETE] Deletou resposta do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->EnqueteModel->respostaDeletar($id);
		Enquete::respostalistar($idPergunta);
	}
	
	function respostaManter()
	{	
		$this->form_validation->set_rules('resposta', 'Resposta', 'required');
		
		// Traz todos os dados do form para Edição
		$enqueteRespostaPost['row'] = $_POST;
		// Carregar os dados passado através do formulário
		$enqueteResposta = array(
			'resposta' => $this->input->post('resposta'),
			'idPergunta' => $this->input->post('idPergunta')
		);
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/enqueteRespostaManter',$enqueteRespostaPost);
		} else {
			$resposta = $this->input->post('resposta');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){
				// Grava o Log 
				$log = "($session_login) [ENQUETE] Editou  Enquete da resposta ($resposta) do id ($id)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				$this->EnqueteModel->respostaUpdate($id,$enqueteResposta);
			} else {
				// Grava o Log 
				$log  = "($session_login) [ENQUETE] Adicionou  Resposta ($resposta)"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->EnqueteModel->respostaInsert($enqueteResposta);
				$this->AuditoriaModel->insert($auditoria);
			} 
			Enquete::respostaListar($this->input->post('idPergunta'));
		}		
	}
	
}
?>
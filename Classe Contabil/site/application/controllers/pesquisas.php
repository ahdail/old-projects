<?php
class Pesquisas extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();	

		$this->load->model('pesquisamodel',"PesquisaModel");
		
		$this->load->library(array('form_validation', 'session', 'pagination'));
		$this->load->helper(array('login','file'));
	}

	function index() 
	{
		$this->listar();
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/pesquisas/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->PesquisaModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        // Inicializa a paginação.
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        
        $var['pesquisa'] = $this->PesquisaModel->exibir($start, $config['per_page'])->result_array();
        
		$this->render('pesquisa', $var);
	}
	
	function exibirPerguntas($idPesquisa,$qtdPerguntas)
	{
		$var['perguntas'] = $this->PesquisaModel->exibirPergunta($idPesquisa, $qtdPerguntas);
		$var['idPesquisa'] = $idPesquisa;
		$var['qtdPerguntas'] = $qtdPerguntas;
		
		$this->render('pesquisa_responder', $var);
	}
	
	function responder($idPesquisa,$qtdPerguntas)
	{
		$idPerguntas = explode(",", $this->input->post('idPerguntas'));
		
		foreach ($idPerguntas as $idPergunta) {
			$dados = array (
				"idUsuario" => $this->session->userdata('idUsuario'),
				"idPergunta" => $idPergunta,
				"op1" => $this->input->post("op1_{$idPergunta}"),
				"op2" => $this->input->post("op2_{$idPergunta}"),
				"op3" => $this->input->post("op3_{$idPergunta}"),
				"op4" => $this->input->post("op4_{$idPergunta}"),
				"op5" => $this->input->post("op5_{$idPergunta}"),
				"texto" => $this->input->post("texto_{$idPergunta}"),
			);
			
			$this->PesquisaModel->inserirResposta($dados);
		}
		$this->exibirPerguntas($idPesquisa,$qtdPerguntas);
	}
}
?>
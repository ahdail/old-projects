<?php
class JuizoDiario extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('juizodiariomodel',"JuizoDiarioModel");
		$this->load->model('comentarioModel',"ComentarioModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		
		$this->load->library(array ('form_validation', 'pagination'));
		$this->load->helpers(array('login', 'data_helper', 'tag_dicionario'));
	}

	function index() 
	{
		$this->listar();
	}
	
	function ver($id)
	{
    	$var['juizodiario'] = $this->JuizoDiarioModel->ver($id);
		$var['indicacao'] = JuizoDiario::exibirFormIndicacao($id);
		$this->render('juizodiario', $var);
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/juizodiario/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->JuizoDiarioModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        
        // Inicializa a páginação
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();

        $var['juizodiario'] = $this->JuizoDiarioModel->exibir($start, $config['per_page'])->result_array();
        $var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->render('juizodiario', $var);
	}

	//functions responsáveis pelo envio do formulário de INDICAÇÃO de Notícia via ajax 
	function exibirFormIndicacao($id, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Mensagem enviada com sucesso para: $_POST[nome] [$_POST[email]]",
				'id' => $id,
			);	
		}  else {
			$var = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem' 	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
				'id' 	=> $id
			);	
		}
		
		$retorno = $this->load->view('FormEnviarIndicacao',$var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	// Realiza o envio da mensagem de indicação de leitura
	function indicacao($id)
	{
		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules('nome', 'Nome do Destinatário ','required');
		$this->form_validation->set_rules('email', 'Email do Destinatário', 'required|valid_email');
		$this->form_validation->set_rules('msg', 'Mensagem', 'required');
		
    	if ($this->form_validation->run() == FALSE){
			$this->exibirFormIndicacao($id);
		} else {
			$dados = array(
				'nomerem' 	=> $this->session->userdata('login'),
				'emailrem'	=> $this->session->userdata('email'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg')
			);
			$mensagem = "
				{$dados['nome']} fez uma Indicação de Leitura.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/juizodiario/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'], $dados['emailrem'], "Indicação de Leitura - Juizo Diário", $mensagem);
			$this->enviarmail->enviar();
			
			$this->exibirFormIndicacao($id, "ok");
		}
	}
	
/********************************************************************************************/	
}
?>
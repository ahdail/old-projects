<?php
class Pod extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('podmodel',"PodModel");
		
		$this->load->library(array('form_validation', 'pagination'));
		$this->load->helpers(array('login'));
	}

	function index() 
	{
		$this->listar();
	}
	
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/pod/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->PodModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        // Inicializa a páginação
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        
         // Calcula a quantidade de página.
		if($start == 0){
			$var['qtd'] = $config['per_page'];
		}else{
			$var['qtd'] = $start + $config['per_page'];
		}
		// Quantidade total de notícias
		$var['total'] =  $config[total_rows];
        
        $var['pod'] = $this->PodModel->exibir($start, $config['per_page'])->result_array();
		$this->render('pod', $var);
	}
	
	function ver($id)
	{
    	$this->PodModel->contador($id);
    	
		$var['rowPod'] = $this->PodModel->ver($id);
		$var['comentario'] = $this->exibirFormComentario($id);
		$var['indicacao'] = $this->exibirFormIndicacao($id);
		
		$this->render('podclasse', $var);
	}
	
	
	function rss()
	{
		// Cria a instancia da classe de RSS
		$this->load->library('rssfeed');
		
		// Resgata as 15 últimas notícias
		$pods = $this->PodModel->exibir(0, 100)->result_array();
		
		// Cria os $videos no XML
		foreach($pods as $row) {
			$item = array(
				"title" => $row['titulo'],
				"link" => base_url()."pod/ver/".$row['id'],
				"description" => $row['descricao'],
				"pubDate" => $row['data']
			);
			
			$arquivo = array(
				array("type"=>"audio/mp3", "url"=>base_url()."site/podclasse/{$row['arquivo']}")
			);
			
			$this->rssfeed->addItem($item, $arquivo);
		}
		
		// Exibe o documento XML
		echo $this->rssfeed->getXML();
	}
	
//functions responsáveis pelo envio do formulário de COMENTÁRIOS do Vídeo via ajax 
	function exibirFormComentario($id, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Comentário enviado com sucesso e aguardando autorização.",
				'id' => $id,
			);	
		}  else {
			$var = array(
				'email' 		=> $this->input->post('email'),
				'idPod' 		=> $id,
				'comentario'	=> $this->input->post('comentario')
			);	
		}
		
		$retorno = $this->load->view('formEnviarComentario',$var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	// Realiza o envio do comentário do Video
	function comentar($id)
	{
		// Realiza a validação dos compos do Form
		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comentario', 'Comentário', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$this->exibirFormComentario($id);
		} else {
			$dados = array(
				'nome' 			=> $this->session->userdata('login'),
				'email' 		=> $this->session->userdata('email'),
				'idPod' 		=> $id,
				'comentario'	=> $this->input->post('comentario')
			);
			
			$mensagem = "
				{$dados['nome']} fez uma Comentário.<br><br>
				Comentario:
				<br>----------------<br>
				{$dados['comentario']}
				<br>----------------<br>
				
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar("editor@classecontabil.com.br", $dados['email'], "Comentário", $mensagem);
			$this->enviarmail->enviar();
			
			$this->PodModel->comentarPod($dados);
			//$this->ComentarioModel->contador($id);
			$this->exibirFormComentario($id, "ok");
		}
		
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
				'nomerem' 	=> $this->session->userdata('login'),
				'emailrem' 	=> $this->session->userdata('email'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
				'id' 		=> $id
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
		//$this->form_validation->set_rules('nomerem', 'Nome do Remetente', 'required');
		//$this->form_validation->set_rules('emailrem', 'Email do Remetente', 'required|valid_email');
		$this->form_validation->set_rules('nome', 'Nome do Destinatário ','required');
		$this->form_validation->set_rules('email', 'Email do Destinatário', 'required|valid_email');
		$this->form_validation->set_rules('msg', 'Mensagem', 'required');
		
    	if ($this->form_validation->run() == FALSE){
			$this->exibirFormIndicacao($id);
		} else {
			$dados = array(
				'nomerem' 	=>$this->session->userdata('login'),
				'emailrem'	=> $this->session->userdata('email'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
			);
			$mensagem = "
				{$dados['nome']} fez uma Indicação de Video.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/pod/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
		
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'],$dados['emailrem'],"Indicação de Video",$mensagem);
			$this->enviarmail->enviar();
		
			$this->exibirFormIndicacao($id, "ok");
		}
	}
	
}
?>
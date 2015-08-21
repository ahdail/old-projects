<?php
class Artigos extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('artigomodel',"ArtigoModel");
		$this->load->model('comentarioModel',"ComentarioModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		
		$this->load->library(array ('form_validation', 'pagination'));
		$this->load->helpers(array('login', 'tag_dicionario'));
	}

	function index() 
	{
		$this->listar();
	}
	
	function ver($id)
	{
		if ($id) {
			$this->ArtigoModel->update($id);	    	
			
			$var['artigo'] = $this->ArtigoModel->ver($id);
	    	$var['autor'] = $this->ArtigoModel->nomeAutor($id);
		}

		$var['ultimos3Artigos'] = $this->ArtigoModel->ultimos3Artigos($id);
		$var['artigosPrincipais'] = $this->ArtigoModel->exibirPrincipal(); 
		$var['comentario'] = Artigos::exibirFormComentario($id);
		$var['indicacao'] = Artigos::exibirFormIndicacao($id);
		$var['exibirComentarios'] = $this->ArtigoModel->exibirComentarios($id); 
		
		//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->render('artigos', $var);
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/artigos/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->ArtigoModel->getTotal(),
    		'uri_segment' 	=> 3,
	    	'num_links' 	=> 9,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        $query = $this->ArtigoModel->exibir($start, $config['per_page']);
        
        // Inicializa a páginação
        $this->pagination->initialize($config);
        
        // cria links para paginação
        $var['pag'] = $this->pagination->create_links();
        
        // Calcula a quantidade de página.
		if($start == 0){
			$var['qtd'] = $config['per_page'];
		}else{
			$var['qtd'] = $start + $config['per_page'];
		}
		// Quantidade total de notícias
		$var['total'] =  $config[total_rows]; 
        
        $var['artigos'] = $query->result_array();
        $var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->render('artigos', $var);
	}
	
	function juizo(){
		$var['secao'] = "Todos os Juízos Diário";
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->render('artigos', $var);
	}
	
	function direito () { 
		$var['artigos'] = $this->ArtigoModel->exibirDireito();
		$var['secao'] = "Todos os temas de Direito Empresarial";
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$var['validaUsuario'] = "false";
		$this->render('artigos', $var);
	}
/********************************************************************************************	
	functions responsáveis pelo envio do formulário de COMENTÁRIOS da Notícia via ajax 
*/	
	function exibirFormComentario($idArtigo, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Comentário enviado com sucesso e aguardando autorização.",
				'idArtigo' => $idArtigo,
			);	
		}  else {
			$var = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'idArtigo' 		=> $idArtigo,
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
	// Realiza o envio do comentário da Notícia
	function comentar($id)
	{
		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules('comentario', 'Comentário', 'required');
    	
		if ($this->form_validation->run() == FALSE){
			Artigos::exibirFormComentario($id);
		} else {
			$dados = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'idArtigo' 		=> $id,
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
			
			$this->ArtigoModel->comentarArtigo($dados);
			$this->ComentarioModel->update($id);
			$this->exibirFormComentario($id, "ok");
		}
		
	}
/*	
	functions responsáveis pelo envio do formulário de INDICAÇÃO de Notícia via ajax 
*/
	function exibirFormIndicacao($idArtigo, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Mensagem enviada com sucesso para: $_POST[nome] [$_POST[email]]",
				'idArtigo' => $idArtigo,
			);	
		}  else {
			$var = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem' 	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
				'idArtigo' 	=> $idArtigo
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
				'nomerem' 	=>$this->session->userdata('login'),
				'emailrem'	=> $this->session->userdata('email'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg')
			);
			$mensagem = "
				{$dados['nome']} fez uma Indicação de Leitura.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/artigos/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'], $dados['emailrem'], "Indicação de Leitura", $mensagem);
			$this->enviarmail->enviar();
			
			$this->exibirFormIndicacao($id, "ok");
		}
	}
	
	function rss($tipo='artigo')
	{
		// Cria a instancia da classe de RSS
		$this->load->library('rssfeed');
		
		// Resgata as 15 últimas notícias
		if ($tipo == 'artigo') {
			$artigos = $this->ArtigoModel->exibir(0, 100)->result_array();
		} else if ($tipo == 'direito') {
			$artigos = $this->ArtigoModel->exibirDireito();
		}
		
		// Cria os itens no XML
		foreach($artigos as $row) {
			$item = array(
				"title" => $row['titulo'],
				"link" => base_url()."noticias/ver/".$row['id'],
				"description" => $row['resumo'],
				"pubDate" => $row['data']
			);
			$this->rssfeed->addItem($item);
		}
		
		// Exibe o documento XML
		echo $this->rssfeed->getXML();
	}
/********************************************************************************************/	
}
?>
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
    		'last_link' 	=> '�ltima',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        $query = $this->ArtigoModel->exibir($start, $config['per_page']);
        
        // Inicializa a p�gina��o
        $this->pagination->initialize($config);
        
        // cria links para pagina��o
        $var['pag'] = $this->pagination->create_links();
        
        // Calcula a quantidade de p�gina.
		if($start == 0){
			$var['qtd'] = $config['per_page'];
		}else{
			$var['qtd'] = $start + $config['per_page'];
		}
		// Quantidade total de not�cias
		$var['total'] =  $config[total_rows]; 
        
        $var['artigos'] = $query->result_array();
        $var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$this->render('artigos', $var);
	}
	
	function juizo(){
		$var['secao'] = "Todos os Ju�zos Di�rio";
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
	functions respons�veis pelo envio do formul�rio de COMENT�RIOS da Not�cia via ajax 
*/	
	function exibirFormComentario($idArtigo, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Coment�rio enviado com sucesso e aguardando autoriza��o.",
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
	// Realiza o envio do coment�rio da Not�cia
	function comentar($id)
	{
		// Realiza a valida��o dos compos do Form
		$this->form_validation->set_rules('comentario', 'Coment�rio', 'required');
    	
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
				{$dados['nome']} fez uma Coment�rio.<br><br>
				Comentario:
				<br>----------------<br>
				{$dados['comentario']}
				<br>----------------<br>
				
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar("editor@classecontabil.com.br", $dados['email'], "Coment�rio", $mensagem);
			$this->enviarmail->enviar();
			
			$this->ArtigoModel->comentarArtigo($dados);
			$this->ComentarioModel->update($id);
			$this->exibirFormComentario($id, "ok");
		}
		
	}
/*	
	functions respons�veis pelo envio do formul�rio de INDICA��O de Not�cia via ajax 
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
	// Realiza o envio da mensagem de indica��o de leitura
	function indicacao($id)
	{
		// Realiza a valida��o dos compos do Form
		$this->form_validation->set_rules('nome', 'Nome do Destinat�rio ','required');
		$this->form_validation->set_rules('email', 'Email do Destinat�rio', 'required|valid_email');
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
				{$dados['nome']} fez uma Indica��o de Leitura.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/artigos/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'], $dados['emailrem'], "Indica��o de Leitura", $mensagem);
			$this->enviarmail->enviar();
			
			$this->exibirFormIndicacao($id, "ok");
		}
	}
	
	function rss($tipo='artigo')
	{
		// Cria a instancia da classe de RSS
		$this->load->library('rssfeed');
		
		// Resgata as 15 �ltimas not�cias
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
<?php
class Noticias extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('noticiaModel',"NoticiaModel");
		$this->load->model('comentarioModel',"ComentarioModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		
		$this->load->library(array ('form_validation', 'pagination'));
		$this->load->helpers(array('tag_dicionario'));
	}
	function index() 
	{
		$this->listar();
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/noticias/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->NoticiaModel->getTotal(),
    		'uri_segment' 	=> 3,
	    	'num_links' 	=> 9,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> '�ltima',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    		
    	);
                
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        
		// Calcula a quantidade de p�gina.
		if($start == 0){
			$var['qtd'] = $config['per_page'];
		}else{
			$var['qtd'] = $start + $config['per_page'];
		}
		// Quantidade total de not�cias
		$var['total'] =  $config[total_rows]; 
        
        
        
        $var['noticias'] = $this->NoticiaModel->exibir($start, $config['per_page'])->result_array();
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->render('noticias', $var);
	}
	
	function ver($id)
	{
	    $this->NoticiaModel->update($id);
		$var['noticia'] = $this->NoticiaModel->ver($id);
		
		$var['noticiasRelacionadas'] = $this->NoticiaModel->noticiasRelacionadas($id);
		$var['ultimas3Noticias'] = $this->NoticiaModel->ultimas3Noticias($id);
		$var['comentario'] = Noticias::exibirFormComentario($id);
		$var['indicacao'] = Noticias::exibirFormIndicacao($id);
		$var['exibirComentarios'] = $this->NoticiaModel->exibirComentarios($id); 
		//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->render('noticias',$var);
	}

	//functions respons�veis pelo envio do formul�rio de COMENT�RIOS da Not�cia via ajax 
	function exibirFormComentario($idNoticia, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Coment�rio enviado com sucesso e aguardando autoriza��o.",
				'idNoticia' => $idNoticia,
			);	
		}  else {
			$var = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $session_email,
				'idNoticia' 	=> $idNoticia,
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
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comentario', 'Coment�rio', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$this->exibirFormComentario($id);
		} else {
			$dados = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'idNoticia' 	=> $id,
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
			
			$this->NoticiaModel->comentarNoticia($dados);
			$this->ComentarioModel->update($id);
			$this->exibirFormComentario($id, "ok");
		}
		
	}

	//functions respons�veis pelo envio do formul�rio de INDICA��O de Not�cia via ajax 
	function exibirFormIndicacao($idNoticia, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Mensagem enviada com sucesso para: {$_POST['nome']} [{$_POST['email']}]",
				'idNoticia' => $idNoticia,
			);	
		} else {
			$var = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem' 	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
				'idNoticia' => $idNoticia
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
		$this->form_validation->set_rules('nomerem', 'Nome do Remetente', 'required');
		$this->form_validation->set_rules('emailrem', 'Email do Remetente', 'required|valid_email');
		$this->form_validation->set_rules('nome', 'Nome do Destinat�rio ','required');
		$this->form_validation->set_rules('email', 'Email do Destinat�rio', 'required|valid_email');
		$this->form_validation->set_rules('msg', 'Mensagem', 'required');
		
    	if ($this->form_validation->run() == FALSE){
			$this->exibirFormIndicacao($id);
		} else {
			$dados = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem'	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
			);
			$mensagem = "
				{$dados['nomerem']} fez uma Indica��o de Leitura.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/noticias/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
		
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'],$dados['emailrem'],"Indica��o de Leitura",$mensagem);
			$this->enviarmail->enviar();
		
			$this->exibirFormIndicacao($id, "ok");
		}
	}
	
	function rss()
	{
		// Cria a instancia da classe de RSS
		$this->load->library('rssfeed');
		
		// Resgata as 15 �ltimas not�cias
		$noticias = $this->NoticiaModel->exibir(0, 100)->result_array();
		
		// Cria os itens no XML
		foreach($noticias as $row) {
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
	
}
?>
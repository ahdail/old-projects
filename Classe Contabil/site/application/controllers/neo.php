<?php
class Neo extends MY_Controller
{

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('NeoModel',"NeoModel");
		$this->load->model('comentarioModel',"ComentarioModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		
		$this->load->library(array ('form_validation', 'session', 'pagination'));
		$this->load->helpers(array('data', 'login'));
	}

	function index() 
	{
		$this->listar();
	}
	
	function definicao(){
		$this->render('neodefinicao');
	}
	
	function ver($id)
	{
		if ($id) {
	    	$this->NeoModel->update($id);
			$var['neo'] = $this->NeoModel->ver($id);
		} 
		
		$var['ultimas3'] = $this->NeoModel->ultimas3($id);
		$var['comentario'] = Neo::exibirFormComentario($id);
		$var['indicacao'] = Neo::exibirFormIndicacao($id);
		$var['exibirComentarios'] = $this->NeoModel->exibirComentarios($id);
		 
		$this->render('neo',$var);
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/neo/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->NeoModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> '�ltima',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        // Inicializa a pagina��o.
        $this->pagination->initialize($config);
        // cria links para pagina��o
        $var['pag'] = $this->pagination->create_links();
        $var['neo'] = $this->NeoModel->exibir($start, $config['per_page'])->result_array();
        
		$this->render('neo', $var);
	}
	
	// functions respons�veis pelo envio do formul�rio de COMENT�RIOS da Not�cia via ajax 

	function exibirFormComentario($idNeo, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Coment�rio enviado com sucesso e aguardando autoriza��o.",
				'idNeo' 	=> $idNeo,
			);	
		}  else {
			$var = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'idNeo' 		=> $idNeo,
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
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comentario', 'Coment�rio', 'required');
		
		if ($this->form_validation->run() == FALSE){
			Neo::exibirFormComentario($id);
		} else {
			$dados = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'idNeo'		 	=> $id,
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
			// Mudar para o email do respons�vel
			$this->enviarmail->carregar("adailneto@grupofortes.com.br", $dados['email'], "Coment�rio", $mensagem);
			$this->enviarmail->enviar();
			
			$this->NeoModel->comentarNeo($dados);
			$this->ComentarioModel->update($id);
			Neo::exibirFormComentario($id, "ok");
		}
		
	}
/*	
	functions respons�veis pelo envio do formul�rio de INDICA��O de Not�cia via ajax 
*/
	function exibirFormIndicacao($idNeo, $status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array(
				'mensagem' 	=> "Mensagem enviada com sucesso para: $_POST[nome] [$_POST[email]]",
				'idNeo' => $idNeo,
			);	
		}  else {
			$var = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem' 	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
				'idNeo' 	=> $idNeo
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
			Neo::exibirFormIndicacao($id);
		} else {
			$dados = array(
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem'	=> $this->input->post('emailrem'),
				'nome' 		=> $this->input->post('nome'),
				'email' 	=> $this->input->post('email'),
				'msg'		=> $this->input->post('msg'),
			);
			$mensagem = "
				{$dados['nome']} fez uma Indica��o de Leitura.<br>
				Leia: <a href=\"http://www.classecontabil.com.br/v3/neo/ver/$id\">clique aqui</a><br><br>
				Comentario:
				<br>----------------<br>
				 {$dados['msg']}
				<br>----------------<br>
			";
		
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['email'],$dados['emailrem'],"Indica��o de Leitura",$mensagem);
			$this->enviarmail->enviar();
		
			Neo::exibirFormIndicacao($id, "ok");
		}
	}
	
}
?>
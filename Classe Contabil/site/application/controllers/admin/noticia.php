<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper('date');
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		// Instânciando as Classe do Model
		$this->load->model('admin/noticiamodel',"NoticiaModel");
		$this->load->model('admin/noticiafontemodel',"NoticiaFonteModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		$this->listar();
	}
	 
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/noticia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NoticiaModel->getTotal(),
    		'uri_segment' 	=> 4,
			'num_links' 	=> 19,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->NoticiaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $noticia['pag'] = $this->pagination->create_links();
		// Carregar os dados da Fonte da Noticia
		$noticia['fontes'] = $this->NoticiaFonteModel->listarTodas();
        $noticia['noticia'] = $query->result_array();
        
		$this->load->view('admin/noticialistar',$noticia);
	}
	// Marca o notícia como: Exibir como Destaque 
	function exibirDestaque($id,$tipo)
	{
		$noticia = array('exibirDestaque' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [NOTÍCIA] Alterou o  Notícia exibir Destaque para ($tipo) do id ($id)";
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->NoticiaModel->exibirLista($id,$noticia);
		Noticia::listar();
	}
	// Marca o notícia como: Exibir como na Pág. Princiapl
	function exibirPrincipal($id,$tipo)
	{
		$noticia = array('exibirPrincipal' => $tipo);
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [NOTÍCIA] Alterou o  Notícia exibir Principal para ($tipo) do id ($id)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->NoticiaModel->exibirLista($id,$noticia);
		Noticia::listar();
	}
	
	function detalhar($id=0, $variaveis=false)
	{
		if ($id) {
	    	$var['row'] = $this->NoticiaModel->detalhar($id);
	    	$data = $this->NoticiaModel->exibirData($id);
	    	$var['row']['data'] = $this->funcoes->converte_data($data['data']);
		}
		if ($variaveis) $var = $variaveis;
		$var['tag'] = Noticia::tagListar($id,0,"0");
		// Carregar os dados da Fonte da Noticia
		$var['fontes'] = $this->NoticiaFonteModel->listarTodas();
		$this->load->view('admin/noticiamanter',$var);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [NOTÍCIA] Deletou a Notícia do id ($id)"; 
		$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
		$this->AuditoriaModel->insert($auditoria);
		$this->NoticiaModel->deletar($id);
		Noticia::listar();
	}
	
	
	function manter()
	{
		// Carregar os dados da Fonte da Noticia
		$noticia['fontes'] = $this->NoticiaFonteModel->listarTodas();
			
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required');
		
		// Traz todos os dados do form para Edição
		$noticiaPost['row'] = $_POST;
		// Carregar os dados passado através do formulário
		
		// Formatando a data para o formato AAAA-MM-DD
		$data = $this->input->post('data');
		$data_nova = $this->funcoes->converte_data($data);
		$noticia = array(
			'titulo' => $this->input->post('titulo'),
			'data' => $data_nova,
			'resumo' => $this->input->post('resumo'),
			'conteudo' => $this->input->post('conteudo'),
			'inserirImagem' => $this->input->post('inserirImagem'),
			'fonte' => $this->input->post('fonte'),
			'exibirDestaque' => $this->input->post('exibirDestaque'),
			'exibirPrincipal' => $this->input->post('exibirPrincipal')
		);
		
		
		foreach ($_POST as $chave=>$valor){
			if (strpos($chave,'tags_') !== false){	
				$tag[] = $valor; 
			}
		}
		
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			// Carregar os dados da Fonte da Noticia
			$noticiaPost['fontes'] = $this->NoticiaFonteModel->listarTodas();
			$noticiaPost['tag'] = Noticia::tagListar($this->input->post('id'),0,"");
			$this->load->view('admin/noticiamanter',$noticiaPost);
		} else {
			if ($_FILES ['userfile'] ['name']) {
					$config['upload_path'] = 'site/banners';
					$config['allowed_types'] = 'gif|jpg|png|swf';
					$config['max_size'] = '0';
					$config['max_width'] = '0';
					$config['max_height'] = '0';
	
					$this->load->library ('upload', $config);
					
					// Verifica se salvou o arquivo com sucesso
					if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
						$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST ,
						"tag" => $this->tagListar($this->input->post('id'),0,'')
					);
					$this->detalhar(0, $var);
					} else { // Salvou, adiciona no array de insercao no banco
						$data = $this->upload->data ();
						$noticia['icoDestaque'] = $data ['raw_name'] . $data ['file_ext'];
					}
				}
				
			if (!$var['error']) {
				$titulo = $this->input->post('titulo');
				$id = $this->input->post('id');
				if($id){
					// Grava o Log 
					
					$session_login = $this->session->userdata('login'); 
					$log = "($session_login) [NOTÍCIA] Alterou a Notícia do id ($id) do titulo ($titulo)";
					$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
					$this->AuditoriaModel->insert($auditoria);
					$this->NoticiaModel->update($id,$noticia,$tag);
				} else {
					// Grava o Log 
					$session_login = $this->session->userdata('login'); 
					$log = "($session_login) [NOTÍCIA] Adicionou a Notícia do titulo ($titulo) ";
					$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
					$this->NoticiaModel->insert($noticia,$tag);
					$this->AuditoriaModel->insert($auditoria);
				} 
				//$this->listar();
				if ($variaveis) $var = $variaveis;
				$var['tag'] = Noticia::tagListar($id,0,"0");
				// Carregar os dados da Fonte da Noticia
				$var['fontes'] = $this->NoticiaFonteModel->listarTodas();
				$this->load->view('admin/noticiamanter', $var);
			}
		}		
	}
	
	function tagListar($idNoticia=0, $idTag=0, $tag)
	{
		$this->load->helper('request_helper');
		
		if (!$idNoticia) $idNoticia = 0;
		$var['row'] = $_POST;
		$this->load->model('admin/noticiaTagModel');
		$var['row'] = $this->noticiaTagModel->exibe($idNoticia);
		$var['idTag'] = $idTag;
		$var['linha'] = $tag;
		
		$retorno = $this->load->view('admin/noticiataglistar',$var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	
	
	function tagCadastrar()
	{
		$this->load->model('admin/tagmodel',"TagModel");
		
		// Realiza a validação dos compos do Form
		$this->form_validation->set_rules ('tag', 'Tag', 'required');
		
		// Carregar os dados passado através do formulário
		$tag['tag'] = strtoupper($this->input->post('tag'));
		$nomeTag = strtoupper($this->input->post('tag'));
		$num_row = $this->TagModel->verificaTagCadastrada($nomeTag);
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento 
		if ($this->form_validation->run() == FALSE){
			Noticia::tagListar(0,0,0);
		} else {
				$log  = "Adicionou TAG"; 
				$auditoria = array('log' => $log, 'dataHora' => date("Y-m-d h:i:s", now()));
				$this->AuditoriaModel->insert($auditoria);
				if ($num_row > 0) {
					$tagV = "S";
					Noticia::tagListar($this->input->post('id'), $idTag,$tagV);	
				} else {
					$tagV = "N";
					$idTag = $this->TagModel->insert($tag);
					Noticia::tagListar($this->input->post('id'), $idTag,$tagV);	
				}
				// Insere a noticia
				
			// Grava o Log 
		}
	}
	
}
?>
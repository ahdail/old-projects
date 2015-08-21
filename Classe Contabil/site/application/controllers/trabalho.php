<?php
class Trabalho extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();

		$this->load->model('trabalhomodel',"TrabalhoModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('bannerM',"BannerModel");
		$this->load->model('admin/lojamodel',"LojaModel");
		
		$this->load->library(array('form_validation', 'pagination'));
		$this->load->helper(array('login','file','caracteres'));
	}

	function index() 
	{
		$this->listar();
	}
	
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/trabalho/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->TrabalhoModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);

    	// Inicializa a paginação.
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        
        $var['trabalho'] = $this->TrabalhoModel->exibir($start, $config['per_page'])->result_array();
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->render('trabalho', $var);
	}
	
	function formEnvioTrabalho()
	{
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		$var['session_email'] = $this->session->userdata('email');
			
		$this->render('formEnvioTrabalho',$var);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo é obrigatório');
			return false;
		} else {
			
			return true;
		}
	}
	
	function manter() {
		// Validação.
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		$this->form_validation->set_rules('autor', 'Autor(s)', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->render('formEnvioTrabalho',array("row" => $_POST));
		} else {
			// Carrega o array que será inserido no banco
			$trabalho = array(
				'titulo' 		=> $this->input->post('titulo'),
				'email' 		=> $this->input->post('email'),
				'nome' 			=> $this->input->post('nome'),
				'esquema' 		=> $this->input->post('esquema'),
				'resumo' 		=> $this->input->post('resumo'),
				'autor' 		=> nl2br($this->input->post('autor')),
				'orientador' 	=> nl2br($this->input->post('orientador')),
				'tipo' 			=> $this->input->post('tipo'),
				'autorizado' 	=> "A",
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$_FILES["userfile"]["name"] = retiraAcentuacao($_FILES["userfile"]["name"]);
				$config['upload_path'] = 'site/trabalhos/';
				$config['allowed_types'] = 'word|pdf|docx';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				
				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"rowTrab" => $_POST
					);
					
					$this->load->view('formEnvioTrabalho',$var); // Chama a view de detalhes
					
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$data ['raw_name'] = retiraAcentuacao($data ['raw_name']);
					
					$trabalho['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			if (!$var['error']) {
				$this->TrabalhoModel->insert($trabalho);
				$result = array("result" => "Arquivo enviado com sucesso. Aguarde liberação");
				
				$this->render('formEnvioTrabalho',$result);
			}
		}
	}
}
?>
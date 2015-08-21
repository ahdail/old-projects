<?php
class Modelo extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper('date');
		$this->load->library(array('form_validation', 'session', 'funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/modelomodel',"ModeloModel");
	}
	function index() 
	{
		Modelo::listar();
	}
	 
	function listar($start = 0) 
	{
    	$config = array(
    		'base_url' 		=> site_url('/admin/modelo/listar/'),
    		'per_page' 		=> 10,
    		'total_rows'	=> $this->ModeloModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->ModeloModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
		
        $var['modelo'] = $query->result_array();
		$this->load->view('admin/modelolistar',$var);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
	    	$var['row'] = $this->ModeloModel->detalhar($id);
		} 
		$this->load->view('admin/modelomanter',$var);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$modelo['row'] = $this->ModeloModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $modelo['row']['titulo'], $modelo['row']['id'], "Excluiu [MODELO]");
		$this->auditoria->gravar();
		$deletar['arquivo'] = $this->ModeloModel->detalhar($id);
		$caminho = "/srv/www/dominiosv/classecontabil/html/v3/site/documentos/".$deletar['arquivo']['arquivo'];
		//C:/xampp/htdocs/EquipePi/classe/ci/site/documentos/
		unlink($caminho);
		$this->ModeloModel->deletar($id);
		Modelo::listar();
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
	
	function manter()
	{	
		if ($this->input->post('exibir' == 1)) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('modelo', 'Modelo', 'required');
		$this->form_validation->set_rules('exibir', '"Exibir na seção"', 'required');
		
		// Traz todos os dados do form para Edição
		$modeloPost['row'] = $_POST;
		// Carregar os dados passado através do formulário
		$modelo = array(
			'titulo' 		=> $this->input->post('titulo'),
			'modelo' 		=> $this->input->post('modelo'),
			'exibir' 		=> $this->input->post('exibir'),
			'autorizado' 	=> $this->input->post('aut')
		);
		
		// Se foi enviado um arquivo
		if ($_FILES ['userfile'] ['name']) {
			$config['upload_path'] = 'site/documentos/';
			$config['allowed_types'] = 'word|pdf|docx';
			$config['max_size'] = '0';
			$config['max_width'] = '0';
			$config['max_height'] = '0';

			$this->load->library ('upload', $config);
			
			// Verifica se salvou o arquivo com sucesso
			if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
				$var = array(
					"error" => $this->upload->display_errors(),
					"row" => $_POST
				);
				
				$this->detalhar(0, $var); // Chama a view de detalhes
				
			} else { // Salvou, adiciona no array de insercao no banco
				$data = $this->upload->data ();
				$modelo['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
			}
		}
			
		// Após a validação dos campos, e dependendo do resultado, é feito um redirecionamento  
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/modelomanter',$modeloPost);
		} else {
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			$session_login = $this->session->userdata('login');
			if($id){// Edição
				$this->ModeloModel->update($this->input->post('id'),$modelo);
				// Grava o Log 
				$this->auditoria->carregar($session_login, $titulo, $id, "Editou [MODELO]");
				$this->auditoria->gravar();
			} else {// Adição
				$this->ModeloModel->insert($modelo);
				// Grava Log
				$this->auditoria->carregar($session_login, $titulo, $id, "Adicionou [MODELO]");
				$this->auditoria->gravar();
			}
			
			$nomeRementente = $this->input->post('nome');
			$modeloId = $this->input->post('id');
			if ($this->input->post('email') && $this->input->post('aut') == "S"){
				$mensagem = "
					------------------------------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Sugestão de Documentos<br>
					------------------------------------------------------------------------------------------------------<br>
					Olá {$nomeRementente},<br><br>
					Sua sugestão de modelo de documento foi autorizado e está disposnivel no site.<br>
					Acesse: www.classecontabil.com.br/v3/modelo/ver/{$modeloId}<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 	
			} else if ($this->input->post('email') && $this->input->post('aut') == "N"){
				$mensagem = "
					-----------------------------------------------------------------------------------------------------<br>
					Portal da Classe Contábil - Mensagem Automática - Sugestão de Documentos<br>
					-----------------------------------------------------------------------------------------------------<br>
					Olá {$nomeRementente},<br><br>
					Sua sugestão de modelo de documento não foi autorizado.<br><br>
					
					Atenciosamente,<br>
					
					Equipe do Portal da Classe Contábil
					<br><br>
					------------------------------------------------------------------------------------------<br>
					Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
				";
			
				$this->load->library("enviarmail");
				$this->enviarmail->carregar($this->input->post('email'),"classecontabil@classecontabil.com.br","Classe Contábil - Sua solicitação",$mensagem);
				$this->enviarmail->enviar(); 
			}
			Modelo::listar();
		}		
	}
	
}
?>
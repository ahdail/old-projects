<?php
class Modelo extends MY_Controller
{
    function __construct ()
    {
        parent::__construct();
    	
        $this->load->model('modelomodel', "ModeloModel");
    	
        $this->load->library(array ('form_validation','pagination', 'funcoes'));
    }
    
    function index ($start = 0)
    {
    	$config = array(
    		'base_url' 		=> site_url('/modelo/index/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->ModeloModel->getTotal(),
    		'uri_segment' 	=> 3,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
        
        $var['modelo'] = $this->ModeloModel->exibir($start, $config['per_page'])->result_array();
        
        $this->render('modelolistar', $var);
    }
    
    function ver($id)
    {
    	$var['row'] = $this->ModeloModel->ver($id);
    	$this->render('modelo',$var);
    }
    
	//functions responsáveis pelo envio do formulário de INDICAÇÃO via ajax 
	
	
	// Valida o arquivo que será enviado.
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo é obrigatório');
			return false;
		} else {
			return true;
		}
	}
	// Realiza o envio da mensagem de indicação de leitura
	function enviarModelo()
	{
		// Realiza a validação dos campos do Form
		$this->form_validation->set_rules('nome', 'Nome do Contrato', 'required');
		//$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		$this->form_validation->set_rules('resumo', 'Resumo', 'required');
		
		$modeloPost['row'] = $_POST;
		
    	if ($this->form_validation->run() == FALSE){
    		$modeloPost['loja'] = $this->LojaModel->exibirLojaPortal();
			$this->load->view('modelo',$modeloPost);
		} else {
			$dados = array(
				'titulo' 	=> $this->input->post('nome'),
				'nomerem' 	=> $this->input->post('nomerem'),
				'emailrem'	=> $this->input->post('emailrem'),
				'modelo'	=> $this->input->post('resumo'),
				'exibir'	=> 1
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
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$dados['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			$this->ModeloModel->insert($dados);
			$mensagem = "
				{$dados['nomerem']} fez uma Sugestão de Modelo de Documento.<br>
				Para visualizar <a href=\"http://www.classecontabil.com.br/v3/admin\">clique aqui</a> e acesse a administração<br><br>
				Resumo:
				<br>----------------<br>
				 {$dados['resumo']}
				<br>----------------<br>
			";
				 
			$this->load->library("enviarmail");
			$this->enviarmail->carregar($dados['emailrem'],"editor@classecontabil.com.br","Sugestão de Modelo de Documento",$mensagem);
			$this->enviarmail->enviar();
		
			//$this->load->view('modelolistar', $var);
			redirect('modelo', 'location');
		}
	}
    
}
?>
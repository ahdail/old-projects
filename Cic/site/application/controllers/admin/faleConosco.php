<?php
class FaleConosco extends Controller
{
	function __construct()
	{
		parent::__construct();
		// Carrega os modelos que serуo utilizados
		$this->load->model ('admin/faleconosco_model', 'faleModel');
		
		// Carrega as libs que serуo utilizadas
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
	}

	function listar($inicio = 0) 
	{
		// Inicializa a paginaчуo
		$config = array(
    		'base_url' => site_url('/admin/faleConosco/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->faleModel->listarTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'кltima'
    	);
        $this->pagination->initialize($config);

        // Pega os links da paginaчуo
        $var['pag'] = $this->pagination->create_links();
        
        // Pega os registros do faleModel
        $var['rows'] = $this->faleModel->listarTodos($config['per_page'], $inicio);

        // Renderiza a view
        $this->load->view('admin/funcaolistar', $var);
	}
	
	function detalhar($idFuncao = 0)
	{
		// Pega os registros do banco
		if ($idFuncao) $var['row'] = $this->faleModel->listarUm($idFuncao);
		// Renderiza a view
		$this->load->view('admin/funcaomanter', $var);
	}
	
	function manter()
	{
		// Valida os dados recebidos
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('ordem', 'Ordem', 'required|numeric');
		
		if ($this->form_validation->run () == FALSE) { // Se der erro na validaчуo
			$var['row'] = $_POST;
			$this->load->view('admin/funcaomanter', $var);
		
		} else { // Se nуo der erro
			// Pega o ID 
			$idFuncao = $this->input->post('id');
			
			// Prepara o array que serуo manipulado
			$dados = array (
				'nome' => $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'ordem' => $this->input->post('ordem'),
			);
			
			// Verifica se vai inserir ou editar
			if ($idFuncao) { // Edita
				// Edita os dados
				$this->faleModel->editar($idFuncao, $dados);
				
				// Preenche o LOG
				$this->auditoria->carregar(
					$this->session->userdata('login'),
					$this->input->post('nome'),
					$idFuncao,
					"Editou [Fale Conosco/Funcao]"
				);
				
			} else { // Insere
				// Insere os dados
				$this->faleModel->inserir($dados);
				
				// Preenche o LOG
				$this->auditoria->carregar(
					$this->session->userdata('login'),
					$this->input->post('nome'),
					$idFuncao,
					"Adicionou [Fale Conosco/Funcao]"
				);
			}
			
			// Salva o LOG
			$this->auditoria->gravar();
			
			// Retorna o usuсrio para a listagem
			$this->listar();
		}			
	}
	
	function deletar($idFuncao)
	{
		// Deleta o registro;
		$this->faleModel->deletar($idFuncao);
		// Retorna o usuсrio para a listagem
		$this->listar();
	}

}
?>
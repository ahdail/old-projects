<?php
class Consultores extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('consultoresmodel',"ConsultoresModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		$this->load->model('admin/temasconsultoriamodel',"TemasConsultoriaModel");

		$this->load->helper(array('highlight', 'string', 'login', 'tag_dicionario'));
		$this->load->library(array ('form_validation', 'funcoes','session', 'enviarmail', 'pagination'));
	}

	function index() 
	{
		$var['consultores'] = $this->ConsultoresModel->listarTodos();
		$var['totalConsultores'] = $this->ConsultoresModel->getTotal();
		$this->render('consultoresClasse', $var);
	}
	
	function ver($id) 
	{
		$var['consultor'] = $this->ConsultoresModel->ver($id);
		$var['totalConsultores'] = $this->ConsultoresModel->getTotal();
		$this->render('consultores', $var);
	}
	function listar($start = 0)
	{ 
		$config = array(
    		'base_url' 		=> site_url('/consultores/listar/'),
    		'per_page' 		=> 20,
   			'total_rows' 	=> $this->ConsultoresModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
    	
        // Inicializa a paginação.
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();

        $var['consultores'] = $this->ConsultoresModel->verConsultores($start, $config['per_page'])->result_array();
        $this->render('consultores', $var);
	}
	
	function letra($letra) 
	{
        $var['consultores'] = $this->ConsultoresModel->buscar($letra);
        $this->render('consultores', $var);
	}
	
	function buscar() 
	{	
		$search = $this->input->post('search');
		
		if (!$search) {
			$var['consultores'] = $this->ConsultoresModel->exibir("A");
		} else {
	        $var['consultores'] = $this->ConsultoresModel->buscarConsultor($search);
		}
		
		$this->render('consultores', $var);
	}
	
	function estado($estado) 
	{
        $var['consultores'] = $this->ConsultoresModel->listarEstado($estado);
        $var['totalConsultores'] = $this->ConsultoresModel->getTotal();
        $var['estado'] = $estado;
        
        $this->render('consultoresClasse', $var);
	}
	// Meu Classe - Área do Consultor
	function meuClasseConsultor($idConsultor)
	{
		$this->load->model('cargomodel',"CargoModel");
		$this->load->model('estadomodel',"EstadoModel");
		
		$var['row'] = $this->ConsultoresModel->detalhar($idConsultor);
		$var['estados'] = $this->EstadoModel->getAll();
		$var['cargos'] = $this->CargoModel->getAll(); 
		$var['estado'] = $this->EstadoModel->getOne($idConsultor);
		$var['cidades'] = $this->montarCidades($meuClasse['row']['estado'], $meuClasse['row']['cidade']);
		$var['cargo'] = $this->CargoModel->getOne($idConsultor);
		
		$this->render('meuClasseConsultor',$var);
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
	
	function atualizarDados($idConsultor)
	{
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		
		if ($_POST['senha']){
			$this->form_validation->set_rules('senha', 'Senha', 'required|matches[rsenha]');
		} 
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		$this->form_validation->set_rules('ocupacao', 'Ocupação', 'required');
		$this->form_validation->set_rules('curriculo', 'Curriculo', 'required');
		
		$dadosPost['row'] = $_POST;
		if ($this->form_validation->run() == FALSE){
			$this->load->model('cargomodel',"CargoModel");
			$this->load->model('estadomodel',"EstadoModel");
			
			$var['row'] = $this->ConsultoresModel->detalhar($idConsultor);
			$var['estados'] = $this->EstadoModel->getAll();
			$var['cargos'] = $this->CargoModel->getAll(); 
			$var['estado'] = $this->EstadoModel->getOne($idConsultor);
			$var['cargo'] = $this->CargoModel->getOne($idConsultor);
			
			$this->render('meuClasseConsultor',$var);
		} else {
			$dados = array(
				'nome' 			=> $this->input->post('nome'),
				'fone' 			=> $this->input->post('fone'),
				'estado' 		=> $this->input->post('estado'),
				'idOcupacao' 	=> $this->input->post('ocupacao'),
				'cidade' 		=> $this->input->post('cidade'),
				//'consultor' => $this->input->post('consultor'),
				'curriculo' 	=> $this->input->post('curriculo')
			);
			if ($_POST['senha']) $dados['senha'] = md5($this->input->post('senha')); 
			
		/********************** Se foi enviado uma Imagem (avatar)*******************************/
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] 		= 'site/avatar/';
				$config['allowed_types'] 	= 'gif|jpg|png|';
				$config['max_size'] 		= '0';
				$config['max_width'] 		= '0';
				$config['max_height'] 		= '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					$this->detalhar(0, $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$dados['avatar'] = $data ['raw_name'] . $data ['file_ext'];
				}
				
				// Redimensiona a Imagem
				$resize['image_library'] 	= 'GD';
				$resize['source_image'] 	= 'site/avatar/'.$dados['avatar'];
				$resize['maintain_ratio'] 	= TRUE;
				$resize['width'] 			= 80;
				$resize['height'] 			= 80;
				
				$this->load->library('image_lib', $resize);
				$this->image_lib->resize();
			}
			/*************************************************************************/ 
			
			$this->ConsultoresModel->updateMeuClasse($idConsultor,$dados);
			
			$this->meuClasseConsultor($idConsultor);
		}
	}
	
	function montarCidades($estado, $cidade="") {
		// Loads
		$this->load->helper('request');
		$this->load->model('cidademodel',"CidadeModel");
		
		// Monta as cidades
		$var['cidades'] = $this->CidadeModel->getPorEstado($estado);
		$var['cidade'] = $cidade;
		
		// Renderizacao da view
		$retorno = $this->load->view('cidadesEstado', $var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
}	

?>
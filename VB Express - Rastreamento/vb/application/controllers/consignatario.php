<?php
class Consignatario extends Controller {
	
	private $vet_dados = array();
	
	function __construct() 
	{
		parent::__construct();	
	
		$this->load->model('consignatarioModel');
		$this->load->helper(array('login', 'data'));
		$this->load->library(array ('funcoes', 'form_validation', 'pagination','session'));

	}
	
	function index()
	{
		$this->listar();
	}
	function lista($tipo, $cod, $start = 0)
	{
		
		$segmentos = array('/consignatario/lista/', $tipo, $cod);
		$config = array(
    		'base_url' 		=> site_url($segmentos),
    		'per_page' 		=> 5,
   			'total_rows' 	=> $this->consignatarioModel->getTotal(),
    		'uri_segment' 	=> 2,
	    	'num_links' 	=> 20,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Ъltima',
    		//'next_link' 	=> 'Prуximo',
    		//'prev_link' 	=> 'Anterior'
    	);

		$this->vet_dados['dados'] = $this->consignatarioModel->exibir($start, $config['per_page']);
        
        // Inicializa a pбginaзгo
        $this->pagination->initialize($config);
        
        // cria links para paginaзгo
        $this->vet_dados['pag'] = $this->pagination->create_links();
        
        // Quantidade total de notнcias
		$this->vet_dado['total'] = $config['total_rows']; 
		
		if ($tipo = "con"){
			$tipo = "Consignatario";
		}
		
		$this->vet_dados['tipo'] = $tipo;
		$this->vet_dados['cod']  = $cod;
		
		$this->vet_dados["head"] 	 = $this->parser->parse("head", $this->vet_dados, TRUE);
		$this->vet_dados["menu"] 	 = $this->parser->parse("menu", $this->vet_dados, TRUE);
		$this->vet_dados["conteudo"] = $this->parser->parse("listagem", $this->vet_dados, TRUE);
		$this->vet_dados["rodape"]   = $this->parser->parse("rodape", $this->vet_dados, TRUE);
		
		$this->parser->parse("template", $this->vet_dados);
	}
	
	function ver(){
		$this->vet_dados["dados"]    = $this->consignatarioModel->detalhe();	
		$this->vet_dados["head"] 	 = $this->parser->parse("head", $this->vet_dados, TRUE);
		$this->vet_dados["menu"] 	 = $this->parser->parse("menu", $this->vet_dados, TRUE);
		$this->vet_dados["conteudo"] = $this->parser->parse("detalhe", $this->vet_dados, TRUE);
		$this->vet_dados["rodape"]   = $this->parser->parse("rodape", $this->vet_dados, TRUE);
		
		$this->parser->parse("template", $this->vet_dados);
	}
}
?>
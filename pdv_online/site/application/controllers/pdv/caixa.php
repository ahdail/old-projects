<?php
class Caixa extends Controller {

	function __construct() 
	{
	
		parent::Controller();
		$this->load->helper(array('form', 'url','data', 'moeda', 'login'));
		$this->load->library(array ('form_validation', 'session', 'pagination') );
		$this->load->model('pdv/caixamodel',"CaixaModel");
		$this->load->model('pdv/vendamodel',"VendaModel");
		//$this->load->model('admin/auditoriamodel',"AuditoriaModel");
		
	}
	function index() 
	{
		$categoriausuarios['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();		
		$this->load->view('pdv/caixamanter', $categoriausuarios);
	}

	function verifica($idUsuario)
	{
		// verifica se já existi uma caixa aberto para o usuario		
		if ($idUsuario){			
			$resultado['row'] = $this->CaixaModel->verificaCaixa($idUsuario);			
		}
		$this->load->view('pdv/caixaverifica', $resultado);
	}
	
	function abrir($idUsuario) 
	{
		if ($idUsuario){			
			$resultado['row'] = $this->CaixaModel->verificaUltimoCaixa($idUsuario);			
		}
		
		// 1 - true | 0 = false		
		$caixaFechado = $resultado['row']['fechado'];

		if($caixaFechado == "S" || $caixaFechado == ""){
			// Abri novo Caixa, gera um novo numCaixa e Grava o Log
			$caixaUltimo = $resultado['row']['numCaixa'];			
			$caixaProximo = ($caixaUltimo + 1);
			
			$caixa = array(
				'idUsuario' => $idUsuario,
				'dataAbertura' => date("Y-m-d H:i:s, now()"),
				'idMicro' => $_SERVER['SERVER_NAME'],
				'numCaixa' => $caixaProximo,
				'fechado' => "N"
			);
			
			echo " - Novo";
			
			$this->CaixaModel->abrirCaixa($caixa);	
		} else{
			// Continua com  o caixa aberto  e Grava o Log 				

			//echo "<br>".$idUsuario;
			//echo " - Continua";
			
			$var['numCaixa'] = $resultado['row']['numCaixa'];
			//print_r($numCaixa);
			//die();
		}
					
		$var['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();
		$var['totalGeral'] = $this->VendaModel->somatorio($idUsuario, $var['numCaixa']);
		$var['novocaixa'] = true;
		
		$this->load->view('pdv/caixamanter', $var);
	}
	
	
	function fechar($idUsuario, $numCaixa)
	{	

		$caixa = array(			
			'dataFechamento' => date("Y-m-d H:i:s, now()"),
			'fechado' => "S"
		);	
		
		$this->CaixaModel->fecharCaixa($numCaixa, $idUsuario, $caixa);
		$categoriausuarios['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();
		$categoriausuarios['novocaixa'];
		
		Caixa::verifica($idUsuario);
		
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/pdv/caixa/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->CaixaModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'primeira',
    		'last_link' => 'ultima'
    	);
    	
    	$query = $this->CaixaModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $vendas['pag'] = $this->pagination->create_links();
        $vendas['vendas'] = $query->result_array();
		
		print_r($vendas['totalCaixas']);
        $this->load->view('pdv/caixalistar', $vendas);
	}
}
?>
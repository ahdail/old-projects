<?php
class Venda extends Controller {

	function __construct() 
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','data', 'moeda', 'login'));
		$this->load->library(array ('form_validation', 'session', 'pagination') );
		$this->load->model('pdv/vendamodel',"VendaModel");
		$this->load->model('pdv/caixamodel',"CaixaModel");
		$this->load->model('admin/auditoriamodel',"AuditoriaModel");
	}
	function index() 
	{
		$this->load->view('pdv/vendalistar');
	}

	function realizaVenda($numCaixa, $idUsuario)
	{
		$this->form_validation->set_rules('valortotal', 'Valor Total', 'required');
		
		$vendaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			
			$vendaPost['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();			
			$vendaPost['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();
			$vendaPost['totalGeral'] = $this->VendaModel->somatorio($idUsuario, $numCaixa);		
			$vendaPost['novocaixa'] = true;
			$vendaPost['vendaOk'] = false;
			$vendaPost['numCaixa'] = $numCaixa;			
			
			$this->load->view('pdv/caixamanter', $vendaPost);
		} else{
		
			$venda = array(
				'idUsuario' => $idUsuario,
				'idCaixa' => $numCaixa,
				'valorTotal' => $this->input->post('valortotal'),
				'datahoraVenda' => date("Y-m-d H:i:s, now()")		
			);
			
			$indiceQtdCategoria = $this->input->post('qtdCategoria');
			$indiceValorSubTotalCategoria = $this->input->post('valorSubTotalCategoria');
			$this->VendaModel->concluiVenda($venda, $indiceQtdCategoria, $indiceValorSubTotalCategoria );
			
			$var['categoriausuarios'] = $this->CaixaModel->listarCategoriasUsuario();
			$var['totalGeral'] = $this->VendaModel->somatorio($idUsuario, $numCaixa);		
			$var['novocaixa'] = true;
			$var['vendaOk'] = true;
			$var['numCaixa'] = $numCaixa;
			//print_r($venda);
			//die();
			$this->load->view('pdv/caixamanter', $var);
		}	
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/pdv/venda/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->VendaModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'primeira',
    		'last_link' => 'ultima'
    	);
    	
    	$query = $this->VendaModel->exibir($start, $config['per_page']);    	
    	$this->pagination->initialize($config);    	
        $vendas['pag'] = $this->pagination->create_links();
        $vendas['vendas'] = $query->result_array();
		$vendas['totalGeral'] = $this->VendaModel->somatorioGeral();
		$vendas['totalCaixas'] = $this->VendaModel->caixasTotal();			
		
        $this->load->view('pdv/vendalistar', $vendas);
	}
	
}
?>
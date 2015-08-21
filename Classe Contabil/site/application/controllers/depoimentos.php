<?php
class Depoimentos extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/depoimentosmodel',"DepoimentosModel");
			
		$this->load->helper(array('arrobaImg'));
		$this->load->library (array('form_validation', 'funcoes', 'pagination', 'auditoria'));
		
	}
	
	function index()
	{
		$this->listar();
	}
	
	function enviar()
	{
		$this->load->view('depoimentosForm');
	}
	
	function exibirFormDepoimento($status = "")
	{
		$this->load->helper('request_helper');

		if ($status == "ok") {
			$var = array('mensagem'	=> "Depoimento enviado. Aguarde liberação");	
		}  else {
			$var = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'depoimento'	=> $this->input->post('depoimento')
			);	
		}
		
		$retorno = $this->load->view('depoimentosForm',$var, true);
		
		if (is_ajax()) {
			echo $retorno;
		} else {
			return $retorno;
		}
	}
	
	function enviarDepoimento()
	{
		// Realiza a validaï¿½ï¿½o dos compos do Form
		$this->form_validation->set_rules('depoimento', 'Depoimento', 'required');
		
    	if ($this->form_validation->run() == FALSE){
			$this->exibirFormDepoimento($status = "");
		} else {
			$depoimentos = array(
				'nome' 			=> $this->input->post('nome'),
				'email' 		=> $this->input->post('email'),
				'depoimento'	=> $this->input->post('depoimento')
			);
			$mensagem = "
				Olá,<br>
				Foi Enviada novo Depoimento pelo site da Classe Contábil.
				<br><br>
				Esta é uma mensagem automática enviada pelo Portal da Classe Contábil. Não responda!
			";
			
			$this->load->library("enviarmail");
			$this->enviarmail->carregar("editor@classecontabil.com.br", $depoimentos['email'],"Classe Contábil - Novo Depoimento",$mensagem);
			$this->enviarmail->enviar();
			
			$this->DepoimentosModel->insert($depoimentos);
		
			$this->exibirFormDepoimento("ok");
		}
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/depoimentos/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->DepoimentosModel->getTotal(),
    		'uri_segment' 	=> 3,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        $this->pagination->initialize($config);
        $var['pag'] = $this->pagination->create_links();
		
        $var['depoimentos'] = $this->DepoimentosModel->exibirPortal($start, $config['per_page'])->result_array();
		$var['depoimentoForm'] = $this->exibirFormDepoimento();
		
		$this->render('depoimentos', $var);
	}
	
	function cadastrar($id)
	{
		$this->form_validation->set_rules ('nome', 'Nome', 'required');
		$this->form_validation->set_rules ('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules ('depoimento', 'Depoimento', 'required');
		
		$depoimentos = array(
			'nome' 			=> $this->input->post('nome'),
			'email' 		=> $this->input->post('email'),
			'depoimento'   	=> $this->input->post('depoimento')
		);
		
		$depoimentosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			//$this->load->view('depoimentosForm', $depoimentosPost);
			$this->exibirFormDepoimento($id);
		} else {
			$this->DepoimentosModel->insert($depoimentos);
			$depoimento['msg'] = "Depoimento enviado. Aguarde liberação";
		}	
		//$this->load->view('depoimentosForm',$depoimento);
		$this->exibirFormDepoimento($id, "ok");
	}
	
}
?>
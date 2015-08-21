<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/eventosmodel',"EventosModel");
		$this->load->model('admin/secretariasmodel',"SecretariaModel");

	}

	public function index()
	{		
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['eventos_todos'] = $this->EventosModel->eventos_todos();
		$this->load->view('admin/eventos', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    		$var['eve'] = $this->EventosModel->detalhar($id);
			$var['eventos_todos'] = $this->EventosModel->eventos_todos();
			$var['secretarias'] = $this->SecretariaModel->secretarias();
		}
		$this->load->view('admin/eventos', $var);
	}
	
	function deletar($id) 
	{
		$this->EventosModel->deletar($id);
		$var['secretarias'] = $this->SecretariaModel->secretarias();
		$var['eventos_todos'] = $this->EventosModel->eventos_todos();
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/eventos', $var);
	}
	
	
	
	
	function manter() 
	{
		
		if(!empty($_POST['data'])){
			$divi = explode("/", $_POST['data']);
			$data_sql = $divi[2]."-".$divi[1]."-".$divi[0];
		}
		
		$this->form_validation->set_rules('titulo', 'Nome do Evento', 'required');
		$this->form_validation->set_rules('data', 'Data da Inicial','required');
	$this->form_validation->set_rules('descricao', 'Descrição do Evento','required');
		
		
		
		$eventoPost['eve'] = $_POST;
		$eventoPost['eve']['data'] = $data_sql;
		
		
		$eventoPost['secretarias'] = $this->SecretariaModel->secretarias();
		$eventoPost['eventos_todos'] = $this->EventosModel->eventos_todos();
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/eventos', $eventoPost);
		} else {
			$evento = array(
				'id_secretaria' => $this->input->post('id_secretaria'),
				'titulo' => $this->input->post('titulo'),
				'data' => $data_sql,
				'local' => $this->input->post('local'),
				'descricao' => $this->input->post('descricao'),			
			);
			
			
			$idevento = $this->input->post('id');
			if($idevento){				
				$this->EventosModel->update($idevento, $evento);
				$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
			} else {				
				$this->EventosModel->insert($evento);
				$var['cadastroOK'] = "Cadastro realizado com sucesso!";
			} 
			
			$var['eventos_todos'] = $this->EventosModel->eventos_todos();
			$var['secretarias'] = $this->SecretariaModel->secretarias();
			
			$this->load->view('admin/eventos', $var);
		}	
	}
	
}
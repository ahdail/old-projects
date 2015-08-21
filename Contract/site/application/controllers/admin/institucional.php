<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucional extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'login', 'date', 'data'));
		$this->load->library(array('form_validation','pagination', 'session'));
		$this->load->model('admin/institucionalmodel',"InstitucionalModel");		

	}

	public function index()
	{	
		$this->load->view('admin/institucional', $var);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$var['institucional'] = $this->InstitucionalModel->detalhar($id);			
		}
		$this->load->view('admin/institucional', $var);
	}
	
	function deletar($id) 
	{
		$this->InstitucionalModel->deletar($id);		
		$var['excluirOK'] = "Excluído com sucesso!";
		$this->load->view('admin/institucional', $var);
	}

	function manter() 
	{
		$institucional = array(
			'missao' => $this->input->post('missao'),
			'valores' => $this->input->post('valores'),
			'quem_somos' => $this->input->post('quem_somos'),
			'diferenciais' => $this->input->post('diferenciais')
		);

		$idinstitucional = $this->input->post('id');
		if($idinstitucional){				
			$this->InstitucionalModel->update($idinstitucional, $institucional);
			$var['atualizadoOK'] = "Cadastro atualizado com sucesso!";
		} 
		$var['institucional'] = $this->InstitucionalModel->detalhar($idinstitucional);		
		
		$this->load->view('admin/institucional', $var);
			
	}
	
}
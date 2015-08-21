<?php
class VozCidadao extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper( array ('form', 'url','date','login'));
		$this->load->library(array ('form_validation', 'session','funcoes', 'pagination') );
		$this->load->model('admin/vozcidadaomodel',"vozcidadaoModel");	
		
		// assunto da voz do cidadão
		$this->load->model('admin/vereadoresmodel',"VereadoresModel");		
	}

	function index()
	{
		
		$vozcidadao['assunto'] = $this->VereadoresModel->assunto();
		$this->load->view('admin/vozcidadaomanter', $vozcidadao);
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/vozcidadao/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->vozcidadaoModel->getTotal(),
    		'uri_segment'	=> 4,
    		'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '<< Primeira',
    		'last_link' 	=> 'Última >>'
    	);
    	
    	$query = $this->vozcidadaoModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $vozcidadao['pag'] = $this->pagination->create_links();
        $vozcidadao['vozcidadao'] = $query->result_array();
		
		$vozcidadao['assunto'] = $this->VereadoresModel->assunto();
        $this->load->view('admin/vozcidadaolistar',$vozcidadao);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$vozcidadao['row'] = $this->vozcidadaoModel->detalhar($id);
		} 
		$vozcidadao['assunto'] = $this->VereadoresModel->assunto();
		$this->load->view('admin/vozcidadaomanter', $vozcidadao);
	}
	
	function deletar($id)
	{
		$this->vozcidadaoModel->deletar($id);
		VozCidadao::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('id_assunto', 'Assunto', 'required');
		$this->form_validation->set_rules('mensagem', 'Mensagem', 'required');
		$this->form_validation->set_rules('mostrar', 'Mostrar', 'required');
		
		$vozcidadaoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/vozcidadaomanter',$vozcidadaoPost);
		} else {
			$vozcidadao = array(
				'nome' 	=> $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'id_assunto' => $this->input->post('id_assunto'),
				'mensagem' => $this->input->post('mensagem'),
				'mostrar' 	=> $this->input->post('mostrar')
			);
			
			$idvozcidadao = $this->input->post('id');
			if($idvozcidadao){
				$this->vozcidadaoModel->update($idvozcidadao, $vozcidadao);
				//print_r($vozcidadao);
			} else {
				$this->vozcidadaoModel->insert($vozcidadao);
				//print_r($vozcidadao);
			} 
			VozCidadao::listar();
		}
	}
}
?>
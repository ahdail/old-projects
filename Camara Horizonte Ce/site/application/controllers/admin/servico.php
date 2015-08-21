<?php
class Servico extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));
		$this->load->model('admin/servicomodel',"ServicoModel");
	}
	function index() 
	{
		$this->load->view('admin/servicolistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/servico/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ServicoModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
			'first_link' 	=> '« Primeira',
    		'last_link' 	=> 'Última »'
    	);
                
        $query = $this->ServicoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $servico['pag'] = $this->pagination->create_links();
        $servico['servico'] = $query->result_array();
		
		$this->load->view('admin/servicolistar',$servico);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$servico['row'] = $this->ServicoModel->detalhar($id);
		}
		$this->load->view('admin/servicomanter',$servico);
	}
	
	function deletar($id) 
	{
		$this->ServicoModel->deletar($id);
		Servico::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('descricao', 'Descricão', 'required');
						
		$servicoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/servicomanter', $servicoPost);
		} else {
			$servico = array(				
				'descricao' => $this->input->post('descricao'),				
			);
		
			$idservico = $this->input->post('id');
			if($idservico){	
				$this->ServicoModel->update($idservico, $servico);
			} else {						
				$this->ServicoModel->insert($servico);
			} 
			Servico::listar();
		}	
	}
}
?>
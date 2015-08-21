<?php
class Comissao extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination'));	
		$this->load->model('admin/comissaomodel',"ComissaoModel");		
	}
	function index() 
	{
		$this->load->view('admin/comissaomanter');
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$comissao['row'] = $this->ComissaoModel->detalhar($id);
		}
		$this->load->view('admin/comissaomanter',$comissao);
	}
	
	function deletar($id) 
	{
		$this->ComissaoModel->deletar($id);		
		Comissao::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/comissao/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->ComissaoModel->getTotal(),
    		'uri_segment' 	=> 4,
			'cur_tag_open'	=> '<span class="current">',
			'cur_tag_close'	=> '</span>',
    		'first_link' 	=> '« Primeira',
    		'last_link' 	=> 'Última »'
    	);
                
        $query = $this->ComissaoModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $comissao['pag'] = $this->pagination->create_links();
        $comissao['comissao'] = $query->result_array();
		
		$this->load->view('admin/comissaolistar',$comissao);
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		
				
		$comissaoPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/comissaomanter', $comissaoPost);
		} else {
			$comissao = array(
				'nome' 			=> $this->input->post('nome'),
				'descricao' 	=> $this->input->post('descricao')
			);
			
			$idcomissao = $this->input->post('id');
			if($idcomissao){				
				$this->ComissaoModel->update($idcomissao, $comissao);
			} else {				
				$this->ComissaoModel->insert($comissao);
			} 
			Comissao::listar();
		}	
	}
	
}
?>
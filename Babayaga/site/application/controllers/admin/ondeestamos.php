<?php
class OndeEstamos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/ondeestamosmodel',"OndeEstamosModel");
	}
	function index() 
	{
		$this->load->view('admin/ondeestamoslistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/ondeestamos/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->OndeEstamosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->OndeEstamosModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $ondeestamos['pag'] = $this->pagination->create_links();
        $ondeestamos['ondeestamos'] = $query->result_array();
		
		
		$this->load->view('admin/ondeestamoslistar',$ondeestamos);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$ondeestamos['row'] = $this->OndeEstamosModel->detalhar($id);
		}
		$this->load->view('admin/ondeestamosmanter',$ondeestamos);
	}
	
	function deletar($id) 
	{
		
		$this->OndeEstamosModel->deletar($id);
		OndeEstamos::listar();

	}
	
	function manter() 
	{
		$this->form_validation->set_rules('endereco', 'Endereço', 'required');
		$this->form_validation->set_rules('telefone', 'Telefone', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('localizacao', 'Localizacao', 'required');

		$ondeestamosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/ondeestamosmanter', $ondeestamosPost);
		} else {
			$ondeestamos = array(
				'endereco' 		=> $this->input->post('endereco'),
				'telefone' 		=> $this->input->post('telefone'),
				'email' 		=> $this->input->post('email'),
				'localizacao' 	=> $this->input->post('localizacao'),
				'outroemail' 	=>$this->input->post('outroemail')
			);

			
			$idondeestamos = $this->input->post('id');
			if($idondeestamos){				
				$this->OndeEstamosModel->update($idondeestamos, $ondeestamos);
			} else {								
				$this->OndeEstamosModel->insert($ondeestamos);
			} 
			OndeEstamos::listar();
		}	
	}
}
?>
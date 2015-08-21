<?php
class QuemSomos extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper ( array ('form', 'date', 'login') );
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/quemsomosmodel',"QuemSomosModel");
	}
	function index() 
	{
		$this->load->view('admin/quemsomoslistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/quemsomos/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->QuemSomosModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->QuemSomosModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $quemsomos['pag'] = $this->pagination->create_links();
        $quemsomos['quemsomos'] = $query->result_array();
		$this->load->view('admin/quemsomoslistar',$quemsomos);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$quemsomos['row'] = $this->QuemSomosModel->detalhar($id);
		}
		$this->load->view('admin/quemsomosmanter',$quemsomos);
	}
	
	function detetar() 
	{
		// Log
		$quemsomos['row'] = $this->QuemSomosModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $quemsomos['row']['titulo'], $quemsomos['row']['id'], "Excluiu [QUEM SOMOS]");
		$this->auditoria->gravar();
		
		$this->QuemSomosModel->deletar($id);
		//QuemSomos::listar();
		$this->listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		$this->form_validation->set_rules('missao', 'Missão', 'required');
		//$this->form_validation->set_rules('valores', 'Valores', 'required');
		
		$QuemSomosPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/quemsomosmanter', $QuemSomosPost);
		} else {
			$QuemSomos = array(
				'descricao' => $this->input->post('descricao'),
				'missao' 	=> $this->input->post('missao'),
				'valores' 	=> $this->input->post('valores'),
				
			);
			
		
			
			//print_r($QuemSomos);
			$session_login = $this->session->userdata('login');
			$email = $this->input->post('email');
			$idquemsomos = $this->input->post('id');
			if($idquemsomos){
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idquemsomos, "Editou [QUEM SOMOS]");
				$this->auditoria->gravar();
				$this->QuemSomosModel->update($idquemsomos, $QuemSomos);
			} else {
				// Grava Log
				$this->auditoria->carregar($session_login, $email, $idQuemSomos, "Adicionou [QUEM SOMOS]");
				$this->auditoria->gravar();
				
				$this->QuemSomosModel->insert($QuemSomos);
			} 
			QuemSomos::listar();
		}		
	}
}
?>
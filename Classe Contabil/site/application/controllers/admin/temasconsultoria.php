<?php
class TemasConsultoria extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/temasconsultoriamodel',"TemasConsultoriaModel");
	}
	
	function index()
	{
		TemasConsultoria::listar();
	}
	
	function listar()
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/temasConsultoria/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->TemasConsultoriaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $query = $this->TemasConsultoriaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $temas['pag'] = $this->pagination->create_links();
		
        $temas['temas'] = $query->result_array();
        
        $this->load->view('admin/temaslistar', $temas);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
			$temas['row'] = $this->TemasConsultoriaModel->detalhar($id);
		}
		$this->load->view('admin/temasmanter', $temas);
	}
	
	function deletar($id)
	{
		$temas['row'] = $this->TemasConsultoriaModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $temas['row']['tema'], $temas['row']['id'], "Excluiu [TEMA]");
		$this->auditoria->gravar();
		
		$this->TemasConsultoriaModel->deletar($id);
		TemasConsultoria::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules ('tema', 'Tema', 'required');
		
		$temas = array(
			'tema' =>  $this->input->post('tema')
		);
		$temasPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/temasmanter', $temasPost);
		} else {
			$temas = array(
				'tema' => $this->input->post('tema')
			);
			
			$session_login = $this->session->userdata('login');
			$id = $this->input->post('id');
			
			if ($id){// Ediчуo
				$this->TemasConsultoriaModel->update($id, $temas);
				// Grava Log
				$this->auditoria->carregar($session_login, $temas['tema'], $id, "Editou [TEMA]");
				$this->auditoria->gravar();
			} else {// Adiчуo
				$this->TemasConsultoriaModel->insert($temas);
				// Grava Log
				$this->auditoria->carregar($session_login, $temas['tema'], $id, "Adicionou [TEMA]");
				$this->auditoria->gravar();
			}	
			TemasConsultoria::listar();
		}
	}
}
?>
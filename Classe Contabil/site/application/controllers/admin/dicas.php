<?php
class Dicas extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/dicasmodel',"DicasModel");
	}
	
	function index()
	{
		Dicas::listar();
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/admin/dicas/listar/'),
    		'per_page' 		=> 20,
    		'total_rows' 	=> $this->DicasModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $query = $this->DicasModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $dicas['pag'] = $this->pagination->create_links();
		
        $dicas['dicas'] = $query->result_array();
        
        $this->load->view('admin/dicaslistar', $dicas);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
			$dicas['row'] = $this->DicasModel->detalhar($id);
		}
		$this->load->view('admin/dicasmanter', $dicas);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$dicas['row'] = $this->DicasModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $dicas['row']['titulo'], $dicas['row']['id'], "Excluiu [DICA]");
		$this->auditoria->gravar();
		
		$this->DicasModel->deletar($id);
		Dicas::listar();
	}
	function manter()
	{
		$this->form_validation->set_rules ('dica', 'Dica', 'required');
		$dicas = array(
			'titulo' => $this->input->post('titulo'),
			'dica'   => $this->input->post('dica')
		);
		
		$dicasPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/dicasmanter', $dicasPost);
		} else {
			$session_login = $this->session->userdata('login');
			$titulo = $this->input->post('titulo');
			$id = $this->input->post('id');
			if ($id){// Ediчуo
				$this->DicasModel->update($id,$dicas);
				// Grava Log
				$this->auditoria->carregar($session_login, $titulo, $id, "Editou [DICA]");
				$this->auditoria->gravar();
			} else {// Adiчуo
				$this->DicasModel->insert($dicas);
				// Grava Log
				$this->auditoria->carregar($session_login, $titulo, $id, "Adicionou [DICA]");
				$this->auditoria->gravar();
			}	
			$this->listar();		
		}
	}
}
?>
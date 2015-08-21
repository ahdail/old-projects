<?php
class Dicionario extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/dicionariomodel',"DicionarioModel");
	}
	
	function index()
	{
		Dicionario::listar();
	}
	
	function listar($start = 0) 
	{
        $config = array(
    		'base_url' 		=> site_url('/admin/dicionario/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->DicionarioModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->DicionarioModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $dicionario['pag'] = $this->pagination->create_links();
		
        $dicionario['dicionario'] = $query->result_array();
        $this->load->view('admin/dicionariolistar', $dicionario);
	}
	
	function detalhar($id)
	{
		if ($id) {
			$dicionario['row'] = $this->DicionarioModel->detalhar($id);
		}
		$this->load->view('admin/dicionariomanter', $dicionario);
	}
	
	function deletar($id)
	{
		// Log
		$dicionario['row'] = $this->DicionarioModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $dicionario['row']['titulo'], $dicionario['row']['id'], "Excluiu [Palavra - DICIONÁRIO]");
		$this->auditoria->gravar();
		
		$this->DicionarioModel->deletar($id);
		Comentario::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules ('palavra', 'Palavra', 'required');
		$this->form_validation->set_rules ('significado', 'Significado', 'required');
		$dicionario = array(
			'palavra' => $this->input->post('palavra'),
			'significado' => $this->input->post('significado'),
		);
		$dicionarioPost['row'] = $_POST;
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/dicionariomanter',$dicionarioPost);
		} else {
			$session_login = $this->session->userdata('login');
			$palavra = $this->input->post('palavra');
			$id = $this->input->post('id');
			if ($id){
				// edição
				$this->DicionarioModel->update($id, $dicionario);
				// Grava Log
				$this->auditoria->carregar($session_login, $palavra, $id, "Editou [Palavra - DICIONÁRIO]");
				$this->auditoria->gravar();
			}else{
				// add
				$this->DicionarioModel->insert($dicionario);
				// Grava Log
				$this->auditoria->carregar($session_login, $palavra, $id, "Adicionou [Palavra - DICIONÁRIO]");
				$this->auditoria->gravar();
			}
			Dicionario::listar();
		}
	}
}
?>
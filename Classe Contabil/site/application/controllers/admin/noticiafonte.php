<?php
class NoticiaFonte extends Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->helper(array('form', 'url','date'));
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/noticiafontemodel',"NoticiaFonteModel");
	}
	
	function index()
	{
		NoticiaFonte::listar();
	}
	
	function listar($start=0)
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/noticiafonte/listar/'),
    		'per_page' 		=> 15,
    		'total_rows' 	=> $this->NoticiaFonteModel->getTotal(),
    		'uri_segment' 	=> 4,
			'num_links' 	=> 10,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'кltima'
    	);
                
        $query = $this->NoticiaFonteModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $fonte['pag'] = $this->pagination->create_links();
		
        $fonte['fonte'] = $query->result_array();
        
        $this->load->view('admin/noticiaFonteListar', $fonte);
	}
	
	function detalhar($id = 0)
	{
		if ($id) {
			$fonte['row'] = $this->NoticiaFonteModel->detalhar($id);
		}
		$this->load->view('admin/noticiaFonteManter', $fonte);
	}
	
	function deletar($id)
	{
		$fonte['row'] = $this->NoticiaFonteModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $fonte['row']['tema'], $fonte['row']['id'], "Excluiu [FONTE]");
		$this->auditoria->gravar();
		
		$this->NoticiaFonteModel->deletar($id);
		NoticiaFonte::listar();
	}
	
	function manter()
	{
		$this->form_validation->set_rules ('fonte', 'Fonte', 'required');
		
		$fonte = array(
			'nomeFonte' =>  $this->input->post('fonte'),
			'site' =>  $this->input->post('site')
		);
		$fontePost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/noticiaFonteManter', $fontePost);
		} else {
			$fonte = array(
				'nomeFonte' => $this->input->post('fonte'),
				'site' => $this->input->post('site')
			);
			
			$session_login = $this->session->userdata('login');
			$id = $this->input->post('id');
			
			if ($id){// Ediчуo
				$this->NoticiaFonteModel->update($id, $fonte);
				// Grava Log
				$this->auditoria->carregar($session_login, $fonte['fonte'], $id, "Editou [FONTE]");
				$this->auditoria->gravar();
			} else {// Adiчуo
				$this->NoticiaFonteModel->insert($fonte);
				// Grava Log
				$this->auditoria->carregar($session_login, $fonte['fonte'], $id, "Adicionou [FONTE]");
				$this->auditoria->gravar();
			}	
			NoticiaFonte::listar();
		}
	}
}
?>
<?php
class Newsletter extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->helper(array('url','date'));
		$this->load->library(array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model('admin/newslettermodel',"NewsletterModel");
	}

	function index()
	{
		Newsletter::listar();
	}
	
	function listar($start = 0) 
	{
		$config = array(
    		'base_url' => site_url('/admin/newsletter/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->NewsletterModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Última'
    	);
    	
    	$query = $this->NewsletterModel->exibir($start, $config['per_page']);
    	
    	$this->pagination->initialize($config);
    	
        $newsletter['pag'] = $this->pagination->create_links();
        $newsletter['newsletter'] = $query->result_array();
        $this->load->view('admin/Newsletterlistar',$newsletter);
	}
	
	function detalhar($id)
	{
		if ($id) {
	       	$newsletter['row'] = $this->NewsletterModel->detalhar($id);
		} 
		$this->load->view('admin/newslettermanter',$newsletter);
	}
	
	function deletar($id)
	{
		// Grava o Log 
		$new['row'] = $this->NewsletterModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $new['row']['email'], $new['row']['id'], "Excluiu [Email da NEWSLETTER]");
		$this->auditoria->gravar();
		
		$this->NewsletterModel->deletar($id);
		Newsletter::listar();
	}
	
	function verificaEmail($email)
	{
		$email = $this->NewsletterModel->verificaEmail($email);
		if ($email > 0) {
			$this->form_validation->set_message('verificaEmail', 'E-mail já cadastrado');
			return false;
		} else {
			return true;
		}
	}
	
	function manter()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|callback_verificaEmail');
		
		$newsletterPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/newslettermanter',$newsletterPost);
		} else {
			$newsletter = array(
				'nome' => $this->input->post('nome'),
				'email' => $this->input->post('email')
			);
		
			$idNewsletter = $this->input->post('id');
			if($idNewsletter){
				// Grava Log
				$new['row'] = $this->NewsletterModel->detalhar($idNewsletter);
				$session_login = $this->session->userdata('login');
				$this->auditoria->carregar($session_login, $new['row']['email'], $new['row']['id'], "Editou [Email da NEWSLETTER]");
				$this->auditoria->gravar();
				
				$this->NewsletterModel->update($_POST['id'],$newsletter);
			} else {
				$this->NewsletterModel->insert($newsletter);
				// Grava o Log 
				$session_login = $this->session->userdata('login');
				$this->auditoria->carregar($session_login, $newsletter['email'],"", "Adicionou [Email na NEWSLETTER]");
				$this->auditoria->gravar();
			} 
			Newsletter::listar();
		}
	}
}
?>
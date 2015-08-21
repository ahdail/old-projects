<?php
class Noticia extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->helper(array('form', 'url', 'login'));
		$this->load->library(array('form_validation','session','funcoes', 'pagination', 'auditoria'));
		$this->load->model('admin/noticiamodel',"NoticiaModel");
	}
	function index() 
	{
		$this->load->view('admin/noticialistar');
	}

	function listar($start = 0) 
	{
		$config = array(
    		'base_url' 		=> site_url('/admin/noticia/listar/'),
    		'per_page' 		=> 10,
    		'total_rows' 	=> $this->NoticiaModel->getTotal(),
    		'uri_segment' 	=> 4,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última'
    	);
                
        $query = $this->NoticiaModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
        $noticia['pag'] = $this->pagination->create_links();
        $noticia['noticia'] = $query->result_array();
		
		
		$this->load->view('admin/noticialistar',$noticia);
	}
	
	function detalhar($id=0) 
	{
		if ($id) {
	    	$noticia['row'] = $this->NoticiaModel->detalhar($id);
		}
		$this->load->view('admin/noticiamanter',$noticia);
	}
	
	function deletar($id) 
	{
		$this->NoticiaModel->deletar($id);
		Noticia::listar();
	}
	
	function manter() 
	{
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		$this->form_validation->set_rules('exibir', 'Onde Exibir?', 'required');
				
		$noticiaPost['row'] = $_POST;
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/noticiamanter', $noticiaPost);
		} else {
			$noticia = array(
				'titulo' 	=> $this->input->post('titulo'),
				'descricao' => $this->input->post('descricao'),
				'fonte' 	=> $this->input->post('fonte'),
				'site' 		=> $this->input->post('site'),
				'exibir' 	=> $this->input->post('exibir')
				//'dataFechamento' => date("Y-m-d"),
			);
			
			$idnoticia = $this->input->post('id');
			if($idnoticia){				
				$this->NoticiaModel->update($idnoticia, $noticia);
			} else {				
				$this->NoticiaModel->insert($noticia);
			} 
			Noticia::listar();
		}	
	}
}
?>
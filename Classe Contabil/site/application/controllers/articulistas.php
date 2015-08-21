<?php
class Articulistas extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('artigoModel',"ArtigoModel");
		$this->load->model('comentarioModel',"ComentarioModel");
		
		$this->load->library (array ('form_validation', 'email', 'pagination'));
	}

	function index() 
	{
		$this->listar();
	}
	
	function ver($id)
	{
		if ($id) {
	    	$var['artigo'] = $this->ArtigoModel->ver($id);
	    	$this->ArtigoModel->update($id);
	    	$var['autor'] = $this->ArtigoModel->nomeAutor($id);
		}
		$var['ultimos3Artigos'] = $this->ArtigoModel->ultimos3Artigos($id);
		$var['artigosPrincipais'] = $this->ArtigoModel->exibirPrincipal(); 
		$var['comentario'] = Artigos::exibirFormComentario($id);
		$var['indicacao'] = Artigos::exibirFormIndicacao($id);
		$var['exibirComentarios'] = $this->ArtigoModel->exibirComentarios($id); 
		
		$this->render('artigos', $var);
		
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/artigos/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->ArtigoModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
                
        $query = $this->ArtigoModel->exibir($start, $config['per_page']);
        
        // Inicializa a páginação
        $this->pagination->initialize($config);
        
        // cria links para paginação
        $var['pag'] = $this->pagination->create_links();
		$var['secao'] = "Artigos";
        $var['artigos'] = $query->result_array();
		$this->render('artigos', $var);
	}
	
	
/********************************************************************************************/	

}
?>
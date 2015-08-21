<?php
class Boletim extends MY_Controller {

	function __construct() 
	{
		parent::__construct();	
		
		$this->load->model('boletimmodel',"BoletimModel");
		
		$this->load->library(array('form_validation', 'pagination'));
		$this->load->helpers(array('login'));
	}

	function index() 
	{
		$this->listar();
	}
	
	
	function ver($idBoletim,$data_envio)
	{
    	$var['noticias'] = $this->BoletimModel->verNoticiaBoletim($idBoletim);
    	$var['artigos'] = $this->BoletimModel->verArtigoBoletim($idBoletim);
    	$var['juizo'] = $this->BoletimModel->verJuizoBoletim($idBoletim);
    	$var['data_envio'] = $data_envio;
    	
		$this->render('boletim_ver',$var);
	}
	
	function listar($start = 0)
	{
	    $config = array(
    		'base_url' 		=> site_url('/boletim/listar/'),
    		'per_page' 		=> 10,
   			'total_rows' 	=> $this->BoletimModel->getTotal(),
    		'uri_segment' 	=> 5,
    		'first_link' 	=> 'Primeira',
    		'last_link' 	=> 'Última',
    		'full_tag_open' => '<div id="maisNum" align="center">',
    		'full_tag_close'=> '</div>'
    	);
        
        // Inicializa a paginação.
        $this->pagination->initialize($config);
        // cria links para paginação
        $var['pag'] = $this->pagination->create_links();
        
        $var['boletim'] = $this->BoletimModel->exibir($start, $config['per_page'])->result_array();

        $this->render('boletim', $var);
	}
}
?>
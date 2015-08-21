<?php
class Auditoria extends Controller
{
    function __construct ()
    {
        parent::Controller();
        $this->load->library(array ('session', 'pagination'));
    }
    function index ($start = 0)
    {
    	$this->load->model('admin/auditoriamodel', "AuditoriaModel");	
    	
    	$config = array(
    		'base_url' => site_url('/admin/auditoria/index/'),
    		'per_page' => 20,
    		'total_rows' => $this->AuditoriaModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'кltima'
    	);
                
        $query = $this->AuditoriaModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginaчуo
        $log['pag'] = $this->pagination->create_links();
		
        $log['log'] = $query->result_array();
        
        $this->load->view('admin/auditorialistar', $log);
    }
}
?>
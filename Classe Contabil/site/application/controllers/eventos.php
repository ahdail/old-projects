<?php
class Eventos extends MY_Controller
{
	function __construct() 
	{
		parent::__construct();	

		$this->load->model('admin/eventomodel',"EventoModel");
		
		$this->load->library(array('form_validation', 'session','funcoes', 'pagination', 'auditoria') );
	}
	
	function index() 
	{
		$this->divulgar();
	}
	
	function divulgar()
	{
		$this->render('eventosForm');
	}
	
	function cadastrar()
	{
		$this->form_validation->set_rules('titulo', 'Nome do Evento', 'required');
		$this->form_validation->set_rules('data', 'Data', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('descricao', 'Descri��o', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$var['rowEvento'] = $_POST;
			$this->render('eventosForm',$var);
		} else {
			$data = $this->input->post('data');
			$data_nova = $this->funcoes->converte_data($data);
			$evento = array(
				'titulo' 	=> $this->input->post('titulo'),
				'data' 		=> $data_nova,
				'local' 	=> $this->input->post('local'),
				'email' 	=> $this->input->post('email'),
				'descricao' => $this->input->post('descricao'),
				'autorizado' => "A"
			);
				$this->EventoModel->insert($evento);
			 
				$var['msg'] = "As informa��es sobre o evento foram enviadas com sucesso e aguardam autoriza��o para publica��o.";
				if ($var['msg']){
					// Envia email informando o cadastro.
					$this->load->library("enviarmail");
					$mensagem = "
					Ol�,<br>
					Foi Cadastrado um Evento pelo site da Classe Cont�bil.<br>
					Nome: {$evento['titulo']}<br>
					Data: {$evento['data']}<br>
					<br><br>
					Esta � uma mensagem autom�tica enviada pelo Portal da Classe Cont�bil. N�o responda!";
					
					$this->enviarmail->carregar("editor@classecontabil.com.br", $_POST['email'],"Cadastro de Eventos",$mensagem);
					$this->enviarmail->enviar();    				
				}
				$this->render('eventosForm', $var);
			}
	}
}
?>
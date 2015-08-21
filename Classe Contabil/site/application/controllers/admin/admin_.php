<?php
class Admin extends Controller {

	// É necessario executar o controlador da classe Controller.
	function __construct() {
		// Executa a funcao construtora da classe Controller
		parent::Controller();	
		
		// Qualquer outro codigo necessario.
	}
	
	// A acao index eh iniciada quando nenhuma acao for passada na URL
	function index() {
				
		// o metodo view renderiza uma view, o segundo parametro transporta variaveis do controller para o view
		//$this->load->view('admin/index', $arrayTeste);
		$this->load->view('admin/login');
		
	}
	
	function exibir() {
		// Instancia a classe do modelo e retorna uma query 
		//$this->load->model('cliente');

        //$data['query'] = $this->Cliente->exibe();
		$data['query'] = $this->db->get('cliente');
		
		// Renderiza
		$this->load->view('admin/exibe', $data);
	}
	
	function detalhe($id=0)
	{
		// Se estiver editando
		if ($id>0) {
			$query = $this->db->get_where('cliente', array('idClientes' => $id));
			$data['row'] = $query->row();
			$data['acao'] = "edit";
		} else {
			$data['acao'] = "add";
		}
		// Renderiza
		$this->load->view('admin/detalhe', $data);
	}

	function manipula($acao)
	{
		// Carrega os dados que seram manipulados
		$data = array(
			'Nome' => $_POST['nome'],
			'Email' => $_POST['email'],
			'Telefone' => $_POST['telefone']
		);
		
		// Insere ou edita o registro dependendo da acao
		if ($acao == "add") {
			$this->db->insert('cliente', $data);
		} else {
			$this->db->where('idClientes', $_POST['id']);
			$this->db->update('cliente', $data); 
		}
		
		// Renderiza a lista de clientes
		Cliente::exibir();
	}
	
	function deletar($id)
	{
		$this->db->delete('cliente', array('idClientes' => $id)); 	
		
		// Renderiza a lista de clientes
		Cliente::exibir();
	}
	
	function paths ()
	{
		$this->load->helper('path');
		
		$directory = './../../etc/passwd';
		//echo set_realpath($directory)."<br><br>";
		// returns "/etc/passwd"
		
		$non_existent_directory = './../../path/not/found';
		echo set_realpath($non_existent_directory, TRUE)."<br><br>";
		// returns "/path/not/found"
		
		//echo set_realpath($non_existent_directory, FALSE)."<br><br>";
		// returns an error, as the path could not be resolved
	}
}
?>
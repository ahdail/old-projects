<?php
class MY_Controller extends Controller
{
	function __construct()
	{
		parent::__construct();

		// Carrega os models necessarios
		$this->load->model('admin/lojamodel',"LojaModel");
		$this->load->model('bannerM',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		// Carrega as bibliotecas
		$this->load->library('session');
		$this->load->helpers('data','login');
	}
	
	function render_top()
	{
		// Carrega as variaveis utilizadas
		$var['banner1'] = $this->BannerModel->exibirBannerSitePosicao1();
		$var['session_idUsuario'] = $this->session->userdata('idUsuario'); 			// Id do Usuário
		$var['session_login'] = $this->session->userdata('nome'); 						// Nome
	   	$var['session_email'] = $this->session->userdata('email');						// Email
		$var['session_consultor'] = $this->session->userdata('consultor');
		$var['session_avatar'] = $this->session->userdata('avatar');
		$this->load->view('inicio_inc', $var);
	}

	function render($pagina, $var=null)
	{
		$this->render_top();
		$this->load->view($pagina, $var);
		$this->render_bot();
	}

	function render_bot()
	{
		// Carrega as outras variaveis utilizadas
		$var['loja'] = $this->LojaModel->exibirLojaPortal();
		
		$var['banner2'] = $this->BannerModel->exibirBannerSitePosicao2();
        $var['banner3'] = $this->BannerModel->exibirBannerSitePosicao3();
		$var['banner4'] = $this->BannerModel->exibirBannerSitePosicao4();
			//Carregar enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		// Carrega os indicadores
		//$this->db->query("USE sitefortes");
		mysql_select_db("sitefortes");

		$var['query1'] = $this->db->query("select ind.IND_NOME as nome,val.VAL_VALOR as valor from VAL_IND as val left join INDEXAD as ind on val.VAL_IND_CODIGO = ind.IND_CODIGO where ind.IND_CODIGO = 009 order by val.VAL_DATA desc limit 1")->row_array();
		$var['query2'] = $this->db->query("select ind.IND_NOME as nome,val.VAL_VALOR as valor from	VAL_IND as val left join INDEXAD as ind on val.VAL_IND_CODIGO = ind.IND_CODIGO where ind.IND_CODIGO = 012 order by val.VAL_DATA desc limit 1")->row_array();
		$var['query3'] = $this->db->query("select ind.IND_NOME as nome,val.VAL_VALOR as valor from	VAL_IND as val left join INDEXAD as ind on val.VAL_IND_CODIGO = ind.IND_CODIGO where ind.IND_CODIGO = 041 order by val.VAL_DATA desc limit 1")->row_array();
		$var['query4'] = $this->db->query("select ind.IND_NOME as nome,val.VAL_VALOR as valor from	VAL_IND as val left join INDEXAD as ind on val.VAL_IND_CODIGO = ind.IND_CODIGO where ind.IND_CODIGO = 013 order by val.VAL_DATA desc limit 1")->row_array();
		$var['query5'] = $this->db->query("select ind.IND_NOME as nome,val.VAL_VALOR as valor from	VAL_IND as val left join INDEXAD as ind on val.VAL_IND_CODIGO = ind.IND_CODIGO where ind.IND_CODIGO = 008 order by val.VAL_DATA desc limit 1")->row_array();
		
		// Renderiza a view
		$this->load->view('final_inc', $var);
	}
}
?>
<?php
class Boletim extends Controller
{
    function __construct ()
    {
        parent::Controller();
        $this->load->library(array ('session', 'pagination','enviarmail'));
        $this->load->model('admin/boletimmodel', "BoletimModel");
        $this->load->model('bannerM',"BannerModel");
        $this->load->helper('data_helper');
    }
    function montar()
    {

    	$data_hoje = date("Y-m-d");
    	$ano = explode("-",$data_hoje);
    	$mes = explode("-",$data_hoje);
    	$dia = explode("-",$data_hoje);
    	// Enviar ano.
    	$var['ano_i'] = $ano[0];
    	$var['ano_f'] = $ano[0];
    	// Enviar mes
    	$var['mes_i'] = $mes[1];
    	$var['mes_f'] = $mes[1];
    	// Enviar dia
    	$var['dia_i'] = $ano[2];
    	$var['dia_f'] = $ano[2];
    	// Noticias
    	$var['noticias'] = 	$this->BoletimModel->noticiaData($data_hoje,$data_hoje);
    	// Artigos
    	$var['artigos'] = 	$this->BoletimModel->artigoData($data_hoje,$data_hoje);
    	// Juizoz
    	$var['juizo'] = 	$this->BoletimModel->juizoData();
    	$this->load->view('admin/montar_boletim', $var);
    }

    function ver()
    {
		$diaMesAnoI = 	$this->input->post('ano_i')."-".$this->input->post('mes_i')."-".$this->input->post('dia_i');
		$diaMesAnoF = 	$this->input->post('ano_f')."-".$this->input->post('mes_f')."-".$this->input->post('dia_f');
	    // Noticias
    	$var['noticias'] = 	$this->BoletimModel->noticiaData($diaMesAnoI,$diaMesAnoF);
    	// Artigos
    	$var['artigos'] = 	$this->BoletimModel->artigoData($diaMesAnoI,$diaMesAnoF);
    	// Juizoz
    	$var['juizo'] = 	$this->BoletimModel->juizoData($diaMesAnoI,$diaMesAnoF);
    	//Retorna a data selecionada
    	$var['ano_i'] = $this->input->post('ano_i');
    	$var['dia_i'] = $this->input->post('dia_i');
    	$var['mes_i'] = $this->input->post('mes_i');
    	$var['ano_f'] = $this->input->post('ano_f');
    	$var['mes_f'] = $this->input->post('mes_f');
    	$var['dia_f'] = $this->input->post('dia_f');
    	$var['banner5'] = $this->BannerModel->exibirBannerSitePosicao5();
    	$this->load->view('admin/montar_boletim',$var);
    }

	function ver_montado()
    {
    	$var['boletim_id_aux'] = $this->BoletimModel->todosBoletins();
    	if ($this->input->post('idBoletim')) {
    		$var['ultimoID'] = $this->BoletimModel->verBoletim($this->input->post('idBoletim'));
    		$var['idUltimo'] = $var['ultimoID']['id'];
    		$var['data_envio'] =  $var['ultimoID']['data_criacao'];
    		$var['enviada'] =  $var['ultimoID']['enviada'];
    		// Noticias
	    	$var['noticias'] = 	$this->BoletimModel->verNoticiaBoletim($this->input->post('idBoletim'));
	    	// Artigos
	    	$var['artigos'] = 	$this->BoletimModel->verArtigoBoletim($this->input->post('idBoletim'));
	    	$var['juizo'] = 	$this->BoletimModel->verJuizoBoletim($this->input->post('idBoletim'));
	    	$var['idUltimo'] = $this->input->post('idBoletim');
	    	// Selecionar todos
	    	//$var['noticias'] =
    	} else {
    		$var['ultimoID'] = $this->BoletimModel->ultimoBoletim();
    		$var['idUltimo'] = $var['ultimoID']['id'];
    		$var['data_envio'] =  $var['ultimoID']['data_criacao'];
    		$var['enviada'] =  $var['ultimoID']['enviada'];
	    	$id =  $var['ultimoID']['id'];
	    	$var['idUltimo'] = $id;
	    	// Noticias
	    	$var['noticias'] = 	$this->BoletimModel->verNoticiaBoletim($id);
	    	// Artigos
	    	$var['artigos'] = 	$this->BoletimModel->verArtigoBoletim($id);
	    	$var['juizo'] = 	$this->BoletimModel->verJuizoBoletim($id);
    	}
    	$var['banner5'] = $this->BannerModel->exibirBannerSitePosicao5();
    	$this->load->view('admin/ver_boletim',$var);
    }

    function gravar()
    {
    	// Grava o número de boletins.
    	$data_hoje = date("Y-m-d");
    	$this->BoletimModel->insertBoletimAux($data_hoje);
    	$var['ultimoID'] = $this->BoletimModel->ultimoBoletim();
    	$var['idUltimo'] = $var['ultimoID']['id'];
    	$var['data_envio'] =  $var['ultimoID']['data_criacao'];
    	$var['enviada'] =  $var['ultimoID']['enviada'];
    	$id =  $var['ultimoID']['id'];



    	// Insere no banco.
    	if ($this->input->post('juizo_id')) {
    		$this->BoletimModel->insertBoletimJuizo($id,$this->input->post('juizo_id'));
    	}

    	if ($this->input->post('noticia_id')) {
    		$this->BoletimModel->insertBoletimNoticia($id,$this->input->post('noticia_id'));
    	}
    	if ($this->input->post('artigo_id')) {
    		$this->BoletimModel->insertBoletimArtigo($id,$this->input->post('artigo_id'));
    	}
    	$var['noticias'] = 	$this->BoletimModel->verNoticiaBoletim($id);
    	// Artigos
    	$var['artigos'] = 	$this->BoletimModel->verArtigoBoletim($id);
    	//
	    $var['juizo'] = 	$this->BoletimModel->verJuizoBoletim($id);

	    // Envia todos boletins.
    	$var['boletim_id_aux'] = $this->BoletimModel->todosBoletins();
    	$this->load->view("admin/ver_boletim",$var);

    }


    function enviarBoletim($data_envio, $idBoletim)
    {
    	// Envia o email
    	$var['noticias'] = 	$this->BoletimModel->verNoticiaBoletim($idBoletim);
    	// Artigos
    	$var['artigos'] = 	$this->BoletimModel->verArtigoBoletim($idBoletim);
    	$var['juizo'] = 	$this->BoletimModel->verJuizoBoletim($idBoletim);
    	$var['data_envio'] = $data_envio;
    	$var['idBoletim'] = $idBoletim;
    	$var['banner5'] = $this->BannerModel->exibirBannerSitePosicao5();
    	$mensagem = $this->load->view("admin/boletim",$var,true);
    	$email = $this->BoletimModel->todosEmail();
    	foreach ($email as $row){
    		$this->enviarmail->carregar($row['email'],"retornotreinamentos@gmail.com","Boletim",$mensagem );
			$this->enviarmail->enviar();
    	}
		$status['mensagem'] = "Boletim enviado com sucesso";
		$this->load->view("admin/boletim_popup",$status);
    }

	function testeEnviarBoletim($data_envio,$idBoletim)
    {

    	// Envia o email
    	$var['noticias'] = 	$this->BoletimModel->verNoticiaBoletim($idBoletim);
    	// Artigos
    	$var['artigos'] = 	$this->BoletimModel->verArtigoBoletim($idBoletim);
    	$var['juizo'] = 	$this->BoletimModel->verJuizoBoletim($idBoletim);
    	$var['data_envio'] = $data_envio;
    	$var['idBoletim'] = $idBoletim;
    	$var['banner5'] = $this->BannerModel->exibirBannerSitePosicao5();
    	$mensagem = $this->load->view("admin/boletim",$var,true);
    	$email = array(array("email" => "luanaximenes@grupofortes.com.br")); 
    	foreach ($email as $row){
    		$this->enviarmail->carregar($row['email'],"retornotreinamentos@gmail.com","Boletim",$mensagem );
			$this->enviarmail->enviar();
    	}
		$status['mensagem'] = "Teste de envio do boletim enviado com sucesso";		
		$this->load->view("admin/boletim_popup",$status);
    }

}

?>


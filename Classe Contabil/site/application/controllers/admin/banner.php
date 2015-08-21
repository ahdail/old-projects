<?php
class Banner extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		// Carregando as bibliotecas nativas do CI
		$this->load->helper ( array ('form', 'url', 'date') );
		$this->load->library ( array ('form_validation', 'session', 'pagination') );
		
		// Instвnciando as Classe do Model
		$this->load->model ( 'admin/bannermodel', "BannerModel" );
		$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		Banner::listar($id);
	}
	
	function listar($start = 0,$id = 0) 
	{
		if ($id){
			$banner ['mostra'] = $this->BannerModel->exibirBanner($id);
		} 
			$config = array(
    		'base_url' => site_url('/admin/banner/listar/'),
    		'per_page' => 10,
    		'total_rows' => $this->BannerModel->getTotal(),
    		'uri_segment' => 4,
    		'first_link' => 'Primeira',
    		'last_link' => 'Ъltima'
    	);
                
        $query = $this->BannerModel->exibir($start, $config['per_page']);
        
        // Inciializa a paginacao
        
        $this->pagination->initialize($config);
        
        
        // cria links para paginaзгo
        $banner['pag'] = $this->pagination->create_links();
		
        $banner['banner'] = $query->result_array();
			$this->load->view('admin/bannerlistar', $banner );
	}
	/* Funзгo serve para escolher se o banner serб exibido ou nгo no site.
	*  E tambйm й possivel determinar se o banner abrirб em uma nova janela(_blank) ou nгo. 
	*  $id: o id do banner no banco de dados
	*  $tipo: Determina se o banner sera exibido no site e/ou nova janela - S(Sim) e N(Nгo)
	*  $qualCheck: Determina qual o campo da tabela serб atualizado
	* */ 
	function opcao($id, $tipo, $qualCheck) 
	{
		// Se for  1 o campo exibir da tabela Banner serб atualizado, com o valor preenchido da variбvel $tipo
		$session_login = $this->session->userdata('login');
		if ($qualCheck == 1) {
			$banner = array ('exibir' => $tipo );
			$log = "($session_login) [BANNER] Alterou o  Banner exibir para ($tipo) do id ($id)";
		} 
		// Se for  2 o campo novaJanela da tabela Banner serб atualizado, com o valor preenchido da variбvel $tipo 
		if ($qualCheck == 2) {
			$banner = array ('novaJanela' => $tipo );
			$log = "($session_login) [BANNER] Alterou o  Banner Nova Janela para ($tipo) do id ($id)";
		}
		$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
		$this->AuditoriaModel->insert ($auditoria);
		$this->BannerModel->opcao($id, $banner);
		Banner::listar("");
	}
	
	function deletar($id) {
		// Grava o Log 
		$session_login = $this->session->userdata('login');
		$log = "($session_login) [BANNER] Deletou Banner do id ($id)";
		$deletar['arquivo'] = $this->BannerModel->detalhar($id);
		$caminho = "/srv/www/dominiosv/classecontabil/html/v3/site/banners/".$deletar['arquivo']['arquivo'];
		//C:/xampp/htdocs/EquipePi/classe/ci/site/banners/
		unlink($caminho);
		$auditoria = array ('log' => $log, 'dataHora' => date ("Y-m-d h:i:s", now ()));
		$this->AuditoriaModel->insert ( $auditoria );
		$this->load->model ( 'admin/bannermodel', "BannerModel" );
		$this->BannerModel->deletar($id);
		Banner::listar(0,$id);
	}
	
	function detalhar($id = 0,$variaveis=false) {
		if ($id) {
			$var['row'] = $this->BannerModel->detalhar($id);
		}
		if ($variaveis) $var = $variaveis;
		$this->load->view('admin/bannermanter', $var);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo й obrigatуrio');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() {
		// Validaзгo.
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('altura', 'Altura', 'required|numeric');
		$this->form_validation->set_rules('largura', 'Largura', 'required|numeric');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required|numeric');
		$this->form_validation->set_rules('obs', 'Observaзгo', 'required');
		

		if ($this->form_validation->run () == FALSE) {
			$this->detalhar(0, array("row" => $_POST)); 
		} else {
			// Carrega o array que serб inserido no banco
			$banner = array(
				'largura' => $this->input->post('largura'),
				'titulo' => $this->input->post('titulo'),
				'url' => $this->input->post('url'),
				'obs' => $this->input->post('obs'),
				'novaJanela' => $this->input->post('novaJanela'),
				'posicao' => $this->input->post('posicao'),
				'exibir' => $this->input->post('exibir'),
				'altura' => $this->input->post('altura'),
				'tipo' => $this->input->post('tipo')
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/banners/';
				$config['allowed_types'] = 'gif|jpg|png|swf|mp3';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$var = array(
						"error" => $this->upload->display_errors(),
						"row" => $_POST
					);
					$this->detalhar(0, $var);
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$banner ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			if(!$var['error']) {
					$session_login = $this->session->userdata('login');
					$tituloBanner = $this->input->post('titulo');
					$idBanner = $this->input->post('id');
				if ($idBanner) {
					// Grava o Log 
					$log = "($session_login) [Banner] Alterou banner do tнtulo ($tituloBanner) do id ($idBanner) ";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$this->BannerModel->update($idBanner, $banner);
				} else {
					// Grava o Log 
					$log = "($session_login) [BANNER] Adicionou Banner com o titulo ($tituloBanner)";
					$auditoria = array ('log' => $log, 'dataHora' => date ( "Y-m-d h:i:s", now () ) );
					$this->AuditoriaModel->insert($auditoria);
					$idBanner = $this->BannerModel->insert($banner);
				}
					$this->listar(0,$idBanner);
			}
		}
	}
}
?>
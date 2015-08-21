<?php
class Banner extends Controller {
	
	function __construct() 
	{
		parent::Controller();
		$this->load->helper ( array ('form', 'url', 'date', 'login' ) );
		$this->load->library ( array ('form_validation', 'session', 'pagination', 'auditoria') );
		$this->load->model ( 'admin/bannermodel', "BannerModel" );
		$this->load->model('admin/auditoriamodel', "AuditoriaModel");
	}
	
	function index() 
	{
		$this->listar($id);
	}
	
	function listar($start = 0,$id = 0) 
	{
		if ($id) $banner ['mostra'] = $this->BannerModel->exibirBanner($id);
		 
		$config = array(
	    	'base_url' => site_url('/admin/banner/listar/'),
	    	'per_page' => 10,
	    	'total_rows' => $this->BannerModel->getTotal(),
	    	'uri_segment' => 4,
	    	'first_link' => 'Primeira',
	    	'last_link' => 'Ъltima'
    	);
                
        $query = $this->BannerModel->exibir($start, $config['per_page']);
        $this->pagination->initialize($config);
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
		$banner['row'] = $this->BannerModel->detalhar($id);
		$session_login = $this->session->userdata('login');
		$this->auditoria->carregar($session_login, $banner['row']['titulo'], $banner['row']['id'], "Excluiu [BANNER]");
		$this->auditoria->gravar();
		
		$this->BannerModel->deletar($id);
		Banner::listar(0,$id);
	}
	
	function detalhar($id) {
		if ($id) {
			$banner ['row'] = $this->BannerModel->detalhar($id);
		}
		$this->load->view('admin/bannermanter', $banner);
	}
	
	function validaArquivo($str) {
		global $_FILES;
		
		if (! $_FILES ['userfile'] ['name']) {
			$this->form_validation->set_message('validaArquivo', 'O campo arquivo Г© obrigatГіrio');
			return false;
		} else {
			return true;
		}
	}
	
	function manter() {
		if (!$this->input->post('id')) {
			$this->form_validation->set_rules('userfile', 'Arquivo', 'callback_validaArquivo');
		}
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('altura', 'Altura', 'required|numeric');
		$this->form_validation->set_rules('largura', 'Largura', 'required|numeric');		
		

		if ($this->form_validation->run () == FALSE) {
			$bannerPost ['row'] = $_POST;
			$this->load->view('admin/bannermanter', $bannerPost);
		} else {
			// Carrega o array que serб inserido no banco
			$banner = array(
				'largura'	=> $this->input->post('largura'),
				'titulo'  	=> $this->input->post('titulo'),
				'url' 		=> $this->input->post('url'),				
				'novaJanela'=> $this->input->post('novaJanela'),				
				'ordem'		=> $this->input->post('ordem'),
				'exibir' 	=> $this->input->post('exibir'),
				'altura' 	=> $this->input->post('altura')
				
			);
			
			// Se foi enviado um arquivo
			if ($_FILES ['userfile'] ['name']) {
				$config['upload_path'] = 'site/banners/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';

				$this->load->library ('upload', $config);
				
				// Verifica se salvou o arquivo com sucesso
				if (!$this->upload->do_upload()) { // Nao salvou, retorna pra view
					$error = array ('error' => $this->upload->display_errors());
					$this->load->view ('admin/bannermanter', $error );
				} else { // Salvou, adiciona no array de insercao no banco
					$data = $this->upload->data ();
					$banner ['arquivo'] = $data ['raw_name'] . $data ['file_ext'];
				}
			}
			
			$session_login = $this->session->userdata('login');
			$tituloBanner = $this->input->post('titulo');
			$idBanner = $this->input->post('id');
			if ($idBanner) {
				// Grava o Log 
				$this->auditoria->carregar($session_login, $tituloBanner, $idBanner, "Editou [BANNER]");
				$this->auditoria->gravar();
				
				$this->BannerModel->update($idBanner, $banner);
			} else {
				// Grava o Log 
				$this->auditoria->carregar($session_login, $tituloBanner, $idBanner, "Adicionou [BANNER]");
				$this->auditoria->gravar();
				$idBanner = $this->BannerModel->insert($banner);
			}
			Banner::listar (0,$idBanner);
		}
	}
}
?>
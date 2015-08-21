<?php
class Newsletter extends Controller {

	function __construct()
	{
		parent::Controller();	
		
		$this->load->library('form_validation');
		$this->load->model('admin/newslettermodel',"NewsletterModel");
		$this->load->model('bannermodel',"BannerModel");
		$this->load->model('admin/enquetemodel',"EnqueteModel");
		$this->load->model('admin/novapaginamodel',"NovaPaginaModel");
	}

	function index()
	{
		// Banners
		$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
		$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
		$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
		$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
		
		// Menu e páginas dinâmicas 
		$var['menu']  = $this->NovaPaginaModel->menu();
		
		// Enquete
		$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
		$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
		$this->load->view('newsletter', $var);
	}
	
	function verificaEmail($email)
	{
		$login = $this->NewsletterModel->verificaEmail($email);
		if ($login > 0) {
			$this->form_validation->set_message('verificaEmail', 'E-mail já existe');
			return false;
		} else {
			return true;
		}
	}
	
	function cadastrar()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|callback_verificaEmail');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE){
			// Banners
			$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
			$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
			$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
			$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
			
			// Menu e páginas dinâmicas 
			$var['menu']  = $this->NovaPaginaModel->menu();
			
			// Enquete
			$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
			$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
			
			$this->load->view('newsletter', $var);
		} else {
			$newsletter = array(
					'nome' 	=> $this->input->post('nome'),
					'email' => $this->input->post('email')
			);
			$this->NewsletterModel->insert($newsletter);
			
			// Banners
			$var['bannerLateralUm']  = $this->BannerModel->exibirBannerLateral(1);
			$var['bannerLateralDois']  = $this->BannerModel->exibirBannerLateral(2);
			$var['bannerLateralTres']  = $this->BannerModel->exibirBannerLateral(3);
			$var['bannerRodape']  = $this->BannerModel->exibirBannerRodape();
			
			// Menu e páginas dinâmicas 
			$var['menu']  = $this->NovaPaginaModel->menu();
			
			// Enquete
			$var['rowPergunta'] = $this->EnqueteModel->enquetePerguntaDisponivel();
			$var['enqueteRespostas'] = $this->EnqueteModel->enqueteRespostas();
		
			$var['msg'] = "Seu e-mail foi cadastrado com sucesso<br><br>Em breve você estará recebendo nossa newsletter";
			$this->load->view('newsletter', $var);
		}
	}
	
}
?>
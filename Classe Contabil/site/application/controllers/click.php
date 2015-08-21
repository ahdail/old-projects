<?php
class Click extends Controller {

	function __construct() 
	{
		parent::Controller();
		$this->load->model('clickM',"ClickModel");
		$this->load->model('bannerM',"BannerModel");	
	}

	
	function contadorClick($id)
	{
		$this->ClickModel->update($id);
		$banner = $this->BannerModel->soEndereco($id);
		header("location: {$banner['url']}");
	}
}
?>
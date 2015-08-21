<?php
class Comentarios extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
			
		$this->load->model('comentariomodel',"ComentarioModel");
		$this->load->model('noticiamodel',"NoticiaModel");
		
		$this->load->helper(array('login', 'tag_dicionario'));
		$this->load->library(array ('funcoes', 'pagination','session'));
	}
	
	function noticia($id)
	{
		$var['titulo'] = $this->ComentarioModel->tituloNoticia($id);
	    $var['comentarios'] = $this->ComentarioModel->comentariosNoticia($id);
	    
		$this->render('comentarios',$var);
	}	
	
	function artigo($id)
	{
		$var['comentarios'] = $this->ComentarioModel->comentariosArtigo($id);
		$this->render('comentarios',$var);
	}	
	
	function video($id)
	{
		$var['titulo'] = $this->ComentarioModel->tituloVideo($id);
		$var['comentarios'] = $this->ComentarioModel->comentariosVideo($id);
	    
		$this->render('comentarios',$var);
	}
	
}
?>
<?php
class ComentarModel extends Model {

	function comentarNoticia($comentar) 
	{
		//return $this->db->get_where('noticia', array('id' => $id))->row_array();
		$this->db->insert('noticia_comentario', $comentar);
	}
	
	function comentarArtigo($id) 
	{
		return $this->db->get_where('artigo', array('id' => $id))->row_array();
	}
	
	function comentarJuizo($id) 
	{
		return $this->db->get_where('juizo', array('id' => $id))->row_array();
	}
	
	function comentarDireito($id) 
	{
		return $this->db->get_where('direito', array('id' => $id))->row_array();
	}
	
}	
?>
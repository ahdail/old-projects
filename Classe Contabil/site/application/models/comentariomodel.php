<?php
class ComentarioModel extends Model {
	
// Notícia
	function tituloNoticia($id)
	{
		return $this->db->get_where('noticia' , array('id' => $id))->result_array();
	}

	function comentariosNoticia($id = 0) 
	{
		$this->db->select('*');
		$this->db->from('noticia_comentario');
		$this->db->join('noticia', 'noticia.id  = noticia_comentario.idNoticia');
		$this->db->where('autorizado !=', "N");
		$this->db->where('idNoticia', $id);
		$this->db->order_by("idComentario", "desc"); 
		return $this->db->get()->result_array();	
	}
	
	function update($id)
	{
		$this->db->query("UPDATE noticia SET comentada = 'S' WHERE id = {$id}");
	}
	
// Artigo 
	function tituloArtigo($id)
	{
		return $this->db->get_where('artigo' , array('id' => $id))->result_array();
	}
	
	function comentariosArtigo($id) 
	{
		$this->db->select('*');
		$this->db->from('artigo_comentario');
		$this->db->join('artigo', 'artigo.id  = artigo_comentario.idArtigo');
		$this->db->where('autorizado !=', "N");
		$this->db->where('idArtigo', $id);
		$this->db->order_by("idComentario", "desc");
		return $this->db->get()->result_array();	
	}
	
// Video
	function tituloVideo($id)
	{
		return $this->db->get_where('video' , array('id' => $id))->result_array();
	}
	
	function comentariosVideo($id) 
	{
		$this->db->select('*');
		$this->db->from('video_comentario');
		$this->db->join('video', 'video.id  = video_comentario.idVideo');
		$this->db->where('autorizado !=', "N");
		$this->db->where('idVideo', $id);
		$this->db->order_by("idComentario", "desc");
		return $this->db->get()->result_array();	
	}
	
	/*function update($id)
	{
		$this->db->query("UPDATE noticia SET comentada = 'S' WHERE id = {$id}");
	}*/
	
}
?>
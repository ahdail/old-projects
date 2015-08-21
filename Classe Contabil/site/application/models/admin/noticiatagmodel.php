<?php
class noticiaTagModel extends Model {
	function exibe($idNoticia=0)
	{
		/*$this->db->select('tag.id, tag.tag, noticia_tag.idNoticia as marcado');
		$this->db->from('tag');
		$this->db->join('noticia_tag', "noticia_tag.idNoticia = $idNoticia", 'left');
		return $this->db->get()->result_array();*/
	
		$query = $this->db->query("
		SELECT tag.id, tag.tag, noticia_tag.idNoticia as marcado
		FROM tag
		LEFT JOIN noticia_tag ON noticia_tag.idTag = tag.id and idNoticia = $idNoticia 
		");
		
		return $query->result_array();
	}
}
?>
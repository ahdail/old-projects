<?php
class GaleriaModel extends CI_Model {
	
	function detalhar($id_noticia = 0) {
		return $this->db->get_where('videos', array('id_noticia' => $id_noticia))->row_array();
	}
	
	function insert($noticia)
	{
		$this->db->insert('videos', $noticia);
	}
	
	function deletar($id)
	{
		$this->db->delete('videos', array('Id' => $id));
	}
	
	function update($id, $noticia)
	{
		$this->db->where('Id', $id);
		$this->db->update('videos', $noticia);
	}
	
	function video_destaque()
	{		
		$this->db->select('*');
		$this->db->from('videos');		
		$this->db->limit(1);
		$this->db->order_by("id_video desc");
		return $this->db->get()->row_array();	
	}

	function galeria_album()
	{		
		$this->db->select('*');
		$this->db->from('album');		
		$this->db->order_by("id_album desc");
		return $this->db->get()->result_array();	
	}
	
	function fotos_album($id_album)
	{		
		$this->db->select('*');
		$this->db->from('album_fotos');
		$this->db->where('id_album', $id_album);		
		$this->db->order_by("id_album desc");
		return $this->db->get()->result_array();		
	}
	
	function nome_album($id_album)
	{		
		$this->db->select('titulo');
		$this->db->from('album');		
		$this->db->where('id_album', $id_album);
		return $this->db->get()->row_array();	
	}
	
	
}
?>
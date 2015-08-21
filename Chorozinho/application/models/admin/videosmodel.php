<?php
class VideosModel extends CI_Model {
	
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

	function videos_gerais()
	{		
		$this->db->select('*');
		$this->db->from('videos');		
		$this->db->order_by("id_video desc");
		return $this->db->get()->result_array();	
	}
	
	function video_ver($id_video)
	{		
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('id_video', $id_video);		
		$this->db->order_by("id_video desc");
		return $this->db->get()->row_array();		
	}
	
	
	
}
?>
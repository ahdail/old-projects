<?php
class VideosModel extends CI_Model {
	
	function detalhar($id_video = 0) {
		return $this->db->get_where('videos', array('id_video' => $id_video))->row_array();
	}
	
	function insert($video)
	{
		//print_r($video);
		//die();
		$this->db->insert('videos', $video);
	}
	
	function deletar($id)
	{
		$this->db->delete('videos', array('id_video' => $id));
	}
	
	function update($id, $video)
	{
		$this->db->where('id_video', $id);
		$this->db->update('videos', $video);
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
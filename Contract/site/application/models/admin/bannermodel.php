<?php
class BannerModel extends CI_Model {
	
	function detalhar($id_banner = 0) {
		return $this->db->get_where('banner', array('id_banner' => $id_banner))->row_array();
	}
	
	function insert($banner)
	{
		$this->db->insert('banner', $banner);
	}
	
	function deletar($id)
	{
		$this->db->delete('banner', array('id_banner' => $id));
	}
	
	function update($id, $banner)
	{
		$this->db->where('id_banner', $id);
		$this->db->update('banner', $banner);
	}
	
	function banner_todos()
	{		
		$this->db->select('*');
		$this->db->from('banner');
		//$this->db->where('exibir', 'S');		
		///$this->db->limit(1);
		$this->db->order_by("id_banner desc");
		return $this->db->get()->result_array();
	
	}

	function banner_home()
	{		
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', 'S');		
		$this->db->order_by("id_banner desc");
		return $this->db->get()->result_array();	
	}
	
	
	
}
?>
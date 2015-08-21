<?php
class BannerModel extends Model {
	
	function detalhar($id) {
		return $this->db->get_where('banner', array('id' => $id))->row_array();
	}
	
	function insert($banner)
	{
		$this->db->insert('banner', $banner);
	}
	
	function deletar($id)
	{
		$this->db->delete('banner', array('id' => $id));
	}
	
	function update($idbanner,$banner)
	{
		$this->db->where('id', $idbanner);
		$this->db->update('banner', $banner);
	}
	
	function getTotal() {
		return $this->db->count_all('banner');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->order_by("id desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
	
	function ultimosBanner () 
	{
		$this->db->select('*');
		$this->db->from('banner');		
		$this->db->order_by("id desc");
		$this->db->limit(5);		
		return $this->db->get()->row_array();
	}
	
	
	
	
}
?>
<?php
class AnuncieModel extends Model {
		
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('anuncie');
		$this->db->limit($limit, $start);
		$this->db->order_by('id desc');
		return $this->db->get();
	}
	
	function todas() 
	{
		$this->db->select('*');
		$this->db->from('anuncie');
		return $this->db->get()->result_array();
	}
	
	function getTotal() {
		return $this->db->count_all('anuncie');
	}
	
	function insert($anuncie)
	{
		$this->db->insert('anuncie', $anuncie);
	}
	
}
?>
<?php
class TrabalhoModel extends Model {
		
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('trabalho');
		$this->db->limit($limit, $start);
		$this->db->where('autorizado', "S");
		$this->db->order_by('id desc');
		return $this->db->get();
	}
	
	
	function todas() 
	{
		$this->db->select('*');
		$this->db->from('trabalho');
		return $this->db->get()->result_array();
	}
	
	function getTotal() {
		return $this->db->count_all('trabalho');
	}
	
	function insert($trabalho)
	{
		$this->db->insert('trabalho', $trabalho);
	}
	
}
?>
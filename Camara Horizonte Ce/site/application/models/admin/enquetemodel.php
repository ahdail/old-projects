<?php
class EnqueteModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('enquete', array('id' => $id))->row_array();
	}
	
	function insert($enquete)
	{
		$this->db->insert('enquete', $enquete);
	}
	
	function deletar($id)
	{
		$this->db->delete('enquete', array('id' => $id));
	}
	
	function update($id,$enquete)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete', $enquete);
	}
	
	function getTotal() {
		return $this->db->count_all('enquete');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('enquete');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
}
?>
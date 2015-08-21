<?php
class RedeSocialModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('redesocial', array('id' => $id))->row_array();
	}
	
	function insert($redesocial)
	{
		$this->db->insert('redesocial', $redesocial);
	}
	
	function deletar($id)
	{
		$this->db->delete('redesocial', array('id' => $id));
	}
	
	function update($id,$redesocial)
	{
		$this->db->where('id', $id);
		$this->db->update('redesocial', $redesocial);
	}
	
	function getTotal() {
		return $this->db->count_all('redesocial');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('redesocial');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
}
?>
<?php
class FotoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('foto', array('id' => $id))->row_array();
	}
	
	function insert($foto)
	{
		$this->db->insert('foto', $foto);
	}
	
	function deletar($id)
	{
		$this->db->delete('foto', array('id' => $id));
	}
	
	function update($id,$foto)
	{
		$this->db->where('id', $id);
		$this->db->update('foto', $foto);
	}
	
	function getTotal() {
		return $this->db->count_all('foto');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('foto');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
}
?>
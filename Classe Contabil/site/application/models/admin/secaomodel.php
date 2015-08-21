<?php
class SecaoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('secao', array('id' => $id))->row_array();
	}
	
	function insert($secao)
	{
		$this->db->insert('secao', $secao);
	}
	
	function deletar($id)
	{
		$this->db->delete('secao', array('id' => $id));
	}
	
	function update($id,$secao)
	{
		$this->db->where('id', $id);
		$this->db->update('secao', $secao);
	}
	
	function getTotal() {
		return $this->db->count_all('secao');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('secao');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
}
?>
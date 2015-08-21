<?php
class DicionarioModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('dicionario', array('id' => $id))->row_array();
	}
	
	
	
	function insert($dicionario)
	{
		$this->db->insert('dicionario', $dicionario);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('dicionario');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('dicionario');
	}
	
	function deletar($id)
	{
		$this->db->delete('dicionario', array('id' => $id));
	}
	
	function update($id, $dicionario)
	{
		$this->db->where('id', $id);
		$this->db->update('dicionario', $dicionario);
	}

}
?>
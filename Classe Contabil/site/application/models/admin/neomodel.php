<?php
class NeoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('neo', array('id' => $id))->row_array();
	}
	
	function insert($neo)
	{
		$this->db->insert('neo', $neo);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('neo');
		$this->db->limit($limit, $start);
		$this->db->order_by("id desc");
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('neo');
	}
	
	function deletar($id)
	{
		$this->db->delete('neo', array('id' => $id));
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('neo', array('id' => $id))->row_array();
	}
	
	function update($id, $neo)
	{
		$this->db->where('id', $id);
		$this->db->update('neo', $neo);
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('neo', $exibe);
	}

}
?>
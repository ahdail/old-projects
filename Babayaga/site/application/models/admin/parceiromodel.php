<?php
class ParceiroModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('parceiro', array('id' => $id))->row_array();
	}
	
	function insert($parceiro)
	{
		$this->db->insert('parceiro', $parceiro);
		$idparceiro = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('parceiro');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('parceiro');
	}
	
	function deletar($id)
	{
		$this->db->delete('parceiro', array('id' => $id));
	}
	
	function update ($id, $parceiro)
	{
		$this->db->where('id', $id);
		$this->db->update('parceiro', $parceiro);
	}

}
?>
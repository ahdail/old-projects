<?php
class ModeloModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('modelo', array('id' => $id))->row_array();
	}
	
	function insert($modelo)
	{
		$this->db->insert('modelo', $modelo);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('modelo');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('modelo');
	}
	
	function deletar($id)
	{
		$this->db->delete('modelo', array('id' => $id));
	}
	
	
	function update($id, $modelo)
	{
		$this->db->where('id', $id);
		$this->db->update('modelo', $modelo);
	}
	

}
?>
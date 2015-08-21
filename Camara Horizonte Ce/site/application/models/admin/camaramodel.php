<?php
class CamaraModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('camara', array('id' => $id))->row_array();
	}
	
	function insert($camara)
	{
		$this->db->insert('camara', $camara);
	}
	
	function deletar($id)
	{
		$this->db->delete('camara', array('id' => $id));
	}
	
	function update($id,$camara)
	{
		$this->db->where('id', $id);
		$this->db->update('camara', $camara);
	}
	
	function getTotal() {
		return $this->db->count_all('camara');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('camara');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function mostrar(){
		$this->db->select('*');
		$this->db->from('camara');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	
	
}
?>
<?php
class ApoioModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('apoio', array('id' => $id))->row_array();
	}
	
	function insert($apoio)
	{
		$this->db->insert('apoio', $apoio);
	}
	
	function deletar($id)
	{
		$this->db->delete('apoio', array('id' => $id));
	}
	
	function update($id,$apoio)
	{
		$this->db->where('id', $id);
		$this->db->update('apoio', $apoio);
	}
	
	function getTotal() {
		return $this->db->count_all('apoio');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('apoio');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function apoioSite()
	{
		$this->db->select('*');
		$this->db->from('apoio');
		$this->db->where('mostrar', "S");
		$this->db->limit(5);
		$this->db->order_by('rand()');
		return $this->db->get()->result_array();
	}
	
	
	
}
?>
<?php
class PerfilBabayagaModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('perfilbabayaga', array('id' => $id))->row_array();
	}
	
	function insert($perfilbabayaga)
	{
		$this->db->insert('perfilbabayaga', $perfilbabayaga);
		$idperfilbabayaga = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('perfilbabayaga');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('perfilbabayaga');
	}
	
	function deletar($id)
	{
		$this->db->delete('perfilbabayaga', array('id' => $id));
	}
	
	function update ($id, $perfilbabayaga)
	{
		$this->db->where('id', $id);
		$this->db->update('perfilbabayaga', $perfilbabayaga);
	}
	
	function ultimosPerfis() 
	{
		$this->db->select('*');
		$this->db->from('perfilbabayaga');		
		$this->db->order_by('rand()');
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
	function todosPerfis() 
	{
		$this->db->select('*');
		$this->db->from('perfilbabayaga');		
		$this->db->order_by('rand()');
		return $this->db->get()->result_array();
	}

}
?>
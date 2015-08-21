<?php
class PerfilModel extends Model {
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('perfil', array('id' => $id))->row_array();
	}
	
	function insert($perfil)
	{
		$this->db->insert('perfil', $perfil);
		
	}

	function deletar($id)
	{
		$this->db->delete('perfil', array('id' => $id));
	}
	
	function update($id,$perfil)
	{
		$this->db->where('id', $id);
		$this->db->update('perfil', $perfil);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('perfil');
		$this->db->order_by("perfil ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('perfil');
	}
	
	function todosPerfis()
	{
		$this->db->select('*');
		$this->db->from('perfil');
		$this->db->order_by("id ASC");		
		return $this->db->get()->result_array();
	}
	
}
?>
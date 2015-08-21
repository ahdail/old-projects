<?php
class DicasModel extends Model {

	function insert($dicas)
	{
		$this->db->insert('dicas', $dicas);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('dicas', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('dicas');
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirDicasPortal()
	{
		$this->db->select('*');
		$this->db->from('dicas');
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();	
	}
	
	function getTotal() {
		return $this->db->count_all('dicas');
	}
	
	function deletar($id)
	{
		$this->db->delete('dicas', array('id' => $id));
	}
	
	function update($id, $dicas)
	{
		$this->db->where('id', $id);
		$this->db->update('dicas', $dicas);
	}

}
?>
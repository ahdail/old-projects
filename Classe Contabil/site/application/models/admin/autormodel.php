<?php
class AutorModel extends Model {
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('autor', array('id' => $id))->row_array();
	}
	
	function insert($autor)
	{
		$this->db->insert('autor', $autor);
	}
	
	function deletar($id)
	{
		$this->db->delete('autor', array('id' => $id));
	}
	
	function update($id,$autor)
	{
		$this->db->where('id', $id);
		$this->db->update('autor', $autor);
	}
	
	function exibirAutor()
	{
		$this->db->select('*');
		$this->db->from('autor');
		$this->db->order_by('nome');
		return $this->db->get()->result_array();
		
		//return $this->db->get('autor')->result_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('autor');
		$this->db->limit($limit, $start);
		$this->db->order_by('nome');
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('autor');
	}
	
}
?>
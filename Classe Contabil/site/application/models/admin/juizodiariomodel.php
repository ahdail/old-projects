<?php
class JuizoDiarioModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('juizo_diario', array('id' => $id))->row_array();
	}
	
	function insert($juizodiario)
	{
		$this->db->insert('juizo_diario', $juizodiario);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('juizo_diario');
		$this->db->limit($limit, $start);
		$this->db->order_by("id desc");
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('juizo_diario');
	}
	
	function deletar($id)
	{
		$this->db->delete('juizo_diario', array('id' => $id));
	}
	
	function update($id, $juizodiario)
	{
		$this->db->where('id', $id);
		$this->db->update('juizo_diario', $juizodiario);
	}
	
	function exibirLista($id, $exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('juizo_diario', $exibe);
	}

}
?>
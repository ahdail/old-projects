<?php
class LojaModel extends Model {

	function insert($loja)
	{
		$this->db->insert('loja', $loja);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('loja', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('loja');
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirLojaPortal()
	{
		$this->db->select('*');
		$this->db->from('loja');
		$this->db->where('exibir', "S");
		$this->db->limit(3);
		return $this->db->get()->result_array();	
	}
	
	function getTotal() {
		return $this->db->count_all('loja');
	}
	
	function deletar($id)
	{
		$this->db->delete('loja', array('id' => $id));
	}
	
	function update($id, $loja)
	{
		$this->db->where('id', $id);
		$this->db->update('loja', $loja);
	}

}
?>
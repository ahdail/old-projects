<?php
class ComissaoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('comissao', array('id' => $id))->row_array();
	}
	
	function insert($comissao)
	{
		$this->db->insert('comissao', $comissao);
	}
	
	function deletar($id)
	{
		$this->db->delete('comissao', array('id' => $id));
	}
	
	function update($id,$comissao)
	{
		$this->db->where('id', $id);
		$this->db->update('comissao', $comissao);
	}
	
	function getTotal() {
		return $this->db->count_all('comissao');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('comissao');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function comissaoSite()
	{
		$this->db->select('*');
		$this->db->from('comissao');
		
		return $this->db->get()->result_array();
	}
	
}
?>
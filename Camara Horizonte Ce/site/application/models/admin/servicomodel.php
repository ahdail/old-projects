<?php
class ServicoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('servico', array('id' => $id))->row_array();
	}
	
	function insert($servico)
	{
		$this->db->insert('servico', $servico);
	}
	
	function deletar($id)
	{
		$this->db->delete('servico', array('id' => $id));
	}
	
	function update($id,$servico)
	{
		$this->db->where('id', $id);
		$this->db->update('servico', $servico);
	}
	
	function getTotal() {
		return $this->db->count_all('servico');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('servico');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function mostrarsite()
	{
		$this->db->select('*');
		$this->db->from('servico');
		$this->db->limit(1);
		return $this->db->get()->row_array;
	}
	
	
}
?>
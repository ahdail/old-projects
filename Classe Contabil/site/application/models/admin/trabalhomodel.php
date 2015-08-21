<?php
class TrabalhoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('trabalho', array('id' => $id))->row_array();
	}
	
	function insert($trabalho)
	{
		$this->db->insert('trabalho', $trabalho);
	}
	
	function deletar($id)
	{
		$this->db->delete('trabalho', array('id' => $id));
	}
	
	function update($id,$trabalho)
	{
		$this->db->where('id', $id);
		$this->db->update('trabalho', $trabalho);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('trabalho');
		$this->db->order_by('id desc, autorizado != "S"');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('trabalho');
	}
	
	function opcao($id,$autorizado)
	{
		$this->db->where('id', $id);
		$this->db->update('trabalho', $autorizado);
	}
}
?>
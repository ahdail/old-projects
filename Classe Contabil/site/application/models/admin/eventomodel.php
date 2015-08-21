<?php
class EventoModel extends Model {
	
	function detalhar($id) {
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
	function insert($evento)
	{
		$this->db->insert('evento', $evento);
	}
	
	function deletar($id)
	{
		$this->db->delete('evento', array('id' => $id));
	}
	
	function update($idConteudo,$evento)
	{
		$this->db->where('id', $idConteudo);
		$this->db->update('evento', $evento);
	}
	
	function getTotal() {
		return $this->db->count_all('evento');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('evento');
		$this->db->order_by("data desc");
		$this->db->limit($limit, $start);
		$this->db->order_by("id desc");
		return $this->db->get();
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
}
?>
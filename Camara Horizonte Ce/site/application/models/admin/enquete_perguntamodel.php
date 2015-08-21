<?php
class Enquete_PerguntaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('enquete_pergunta', array('id' => $id))->row_array();
	}
	
	function insert($enquete_pergunta)
	{
		$this->db->insert('enquete_pergunta', $enquete_pergunta);
	}
	
	function deletar($id)
	{
		$this->db->delete('enquete_pergunta', array('id' => $id));
	}
	
	function update($id,$enquete_pergunta)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete_pergunta', $enquete_pergunta);
	}
	
	function getTotal() {
		return $this->db->count_all('enquete_pergunta');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
}
?>
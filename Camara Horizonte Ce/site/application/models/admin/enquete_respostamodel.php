<?php
class Enquete_RespostaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('enquete_resposta', array('id' => $id))->row_array();
	}
	
	function insert($enquete_resposta)
	{
		$this->db->insert('enquete_resposta', $enquete_resposta);
	}
	
	function deletar($id)
	{
		$this->db->delete('enquete_resposta', array('id' => $id));
	}
	
	function update($id, $enquete_resposta)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete_resposta', $enquete_resposta);
	}
	
	function getTotal() {
		return $this->db->count_all('enquete_resposta');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('r.*, p.id as IdPergunta, p.pergunta');
		$this->db->from('enquete_resposta as r');
		$this->db->join('enquete_pergunta as p', 'r.id_pergunta = p.id');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function perguntas()
	{
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		
		return $this->db->get()->result_array();
	}
	
	
}
?>
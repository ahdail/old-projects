<?php
class FaleConoscoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('faleconosco', array('id' => $id))->row_array();
	}
	
	function insert($faleconosco)
	{
		$this->db->insert('faleconosco', $faleconosco);
	}
	
	function deletar($id)
	{
		$this->db->delete('faleconosco', array('id' => $id));
	}
	
	function update($id,$faleconosco)
	{
		$this->db->where('id', $id);
		$this->db->update('faleconosco', $faleconosco);
	}
	
	function getTotal() {
		return $this->db->count_all('faleconosco');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('faleconosco');
		$this->db->order_by("nome asc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function verificaEmail($email)
	{
		$this->db->select('email');
		$this->db->from('faleconosco');
		$this->db->where('email', $email);
		return $this->db->count_all_results();
	}
	
	function exibirSite()
	{
		$this->db->select('*');
		$this->db->from('faleconosco');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	
	
}
?>
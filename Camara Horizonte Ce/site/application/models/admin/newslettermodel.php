<?php
class NewsletterModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('newsletter', array('id' => $id))->row_array();
	}
	
	function insert($newsletter)
	{
		$this->db->insert('newsletter', $newsletter);
	}
	
	function deletar($id)
	{
		$this->db->delete('newsletter', array('id' => $id));
	}
	
	function update($id,$newsletter)
	{
		$this->db->where('id', $id);
		$this->db->update('newsletter', $newsletter);
	}
	
	function getTotal() {
		return $this->db->count_all('newsletter');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('newsletter');
		$this->db->order_by("nome asc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function verificaEmail($email)
	{
		$this->db->select('email');
		$this->db->from('newsletter');
		$this->db->where('email', $email);
		return $this->db->count_all_results();
	}
}
?>
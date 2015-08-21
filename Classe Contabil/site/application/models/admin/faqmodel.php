<?php
class FaqModel extends Model {

	function insert($faq)
	{
		$this->db->insert('faq', $faq);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('faq', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('faq');
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirfaqPortal()
	{
		$this->db->select('*');
		$this->db->from('faq');
		//$this->db->order_by('rand()');
		//$this->db->limit(1);
		return $this->db->get()->result_array();	
	}
	
	function getTotal() {
		return $this->db->count_all('faq');
	}
	
	function deletar($id)
	{
		$this->db->delete('faq', array('id' => $id));
	}
	
	function update($id, $faq)
	{
		$this->db->where('id', $id);
		$this->db->update('faq', $faq);
	}

}
?>
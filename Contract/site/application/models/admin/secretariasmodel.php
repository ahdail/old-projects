<?php
class SecretariasModel extends CI_Model {
	
	function secretarias()
	{		
		$this->db->select('*');
		$this->db->from('secretarias');		
		//$this->db->where('destaque', 'N');	
		//$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function detalhar($id = 0) {
		return $this->db->get_where('secretarias', array('id_secretaria' => $id))->row_array();
	}
	
	function insert($secretarias)
	{
		$this->db->insert('secretarias', $secretarias);
	}
	
	function deletar($id)
	{
		$this->db->delete('secretarias', array('id_secretaria' => $id));
	}
	
	function update($id, $secretarias)
	{
		$this->db->where('id_secretaria', $id);
		$this->db->update('secretarias', $secretarias);
	}
	
	function noticias_secretaria($id)
	{
	
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->where('id_secretaria', $id);	
		$this->db->order_by("data DESC, id_noticia DESC");
		return $this->db->get()->result_array();
		
		
	}
	
	function eventos_secretaria($id)
	{
		$this->db->select('*');
		$this->db->from('agenda');		
		$this->db->where('id_secretaria', $id);	
		$this->db->order_by("data DESC");
		$this->db->limit(5);
		return $this->db->get()->result_array();
	
	}
	
	
	
	
	
}
?>
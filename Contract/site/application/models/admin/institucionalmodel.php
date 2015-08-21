<?php
class InstitucionalModel extends CI_Model {
	
	function detalhar($id_institucional = 0) {
		return $this->db->get_where('institucional', array('id_institucional' => $id_institucional))->row_array();
	}
	
	function insert($institucional)
	{
		//print_r($institucional);
		//die();
		$this->db->insert('institucional', $institucional);
	}
	
	function deletar($id)
	{
		$this->db->delete('institucional', array('id_institucional' => $id));
	}
	
	function update($id, $institucional)
	{
		$this->db->where('id_institucional', $id);
		$this->db->update('institucional', $institucional);
	}
	
	function institucional_destaque()
	{		
		$this->db->select('*');
		$this->db->from('institucional');		
		$this->db->limit(1);
		$this->db->order_by("id_institucional desc");
		return $this->db->get()->row_array();	
	}

	function institucional_gerais()
	{		
		$this->db->select('*');
		$this->db->from('institucional');		
		$this->db->order_by("id_institucional desc");
		return $this->db->get()->result_array();	
	}
	// FrontEnd e BackEnd
	function institucional_ver($id_institucional)
	{		
		$this->db->select('*');
		$this->db->from('institucional');
		$this->db->where('id_institucional', $id_institucional);		
		$this->db->order_by("id_institucional desc");
		return $this->db->get()->row_array();		
	}
	
	
	
}
?>
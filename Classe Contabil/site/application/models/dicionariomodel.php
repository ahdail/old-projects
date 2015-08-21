<?php
class DicionarioModel extends Model {
	
	function detalhar($id) 
	{
		return $this->db->get_where('dicionario', array('id' => $id))->row_array();
	}
	
	function getTotal() 
	{
		return $this->db->count_all('dicionario');
	}
	
	function exibir($letra) 
	{
		$this->db->select('*');
		$this->db->from('dicionario');
		$this->db->like('palavra', $letra, 'after'); 
		return $this->db->get()->result_array();
	}
	
	function getTodos() {
		$this->db->select('id, palavra');
		$this->db->from('dicionario');
		return $this->db->get()->result_array();
	}
	
	function buscar($letra) 
	{
		$this->db->select('*');
		$this->db->from('dicionario');
		$this->db->like('palavra', $letra, 'after'); 
		return $this->db->get()->result_array();
	}
	
	function buscarDic($search) 
	{
		$this->db->select('*');
		$this->db->from('dicionario');
		$this->db->like('palavra', $search, 'match'); 
		$this->db->orlike('significado', $search, 'match'); 
		return $this->db->get()->result_array();
	}
	
}
?>
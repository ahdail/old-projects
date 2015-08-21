<?php
class ModeloModel extends Model {
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('modelo');
		$this->db->where('exibir =', 1);
		$this->db->order_by("titulo ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirAnuncie()
	{
		$this->db->select('*');
		$this->db->from('modelo');
		$this->db->where('exibir =', 2);
		return $this->db->get()->result_array();
	}
	
	function getTotal() {
		return $this->db->count_all('modelo');
	}
	
	function ver($id) 
	{
		return $this->db->get_where('modelo', array('id' => $id))->row_array();
	}
	
	function insert($dados)
	{
		$this->db->insert('modelo', $dados);
	}
	
}
?>
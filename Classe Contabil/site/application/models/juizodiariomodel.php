<?php
class juizoDiarioModel extends Model {
	
	function exibirJuizoDiario()
	{
		$this->db->select('*');
		$this->db->from('juizo_diario');
		//$this->db->where('tipo', "J");
		$this->db->order_by('id desc, data desc');
		return $this->db->get()->result_array();
	}
	
	function exibirJuizoDiarioDestaque()
	{
		$this->db->select('*');
		$this->db->from('juizo_diario');
		//$this->db->where('tipo', "J");
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function ver($id = 0) 
	{
		return $this->db->get_where('juizo_diario', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('juizo_teste');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('juizo_diario');
	}
	
}
?>
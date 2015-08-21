<?php
class Faleconosco_model extends Model
{
	function funcaoListarTodos() {
		$this->db->select('nome, email');
		$this->db->from('funcao');
		$this->db->order_by('ordem');
		return $this->db->get()->result_array();
	}
}
?>
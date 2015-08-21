<?php
class AuditoriaModel extends Model {
	
	function exibir($start, $limit)
	{
		$this->db->select('log,dataHora');
		$this->db->from('auditoria');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('auditoria');
	}
	
	function insert($auditoria)
	{
		$this->db->set($auditoria);
		$this->db->insert('auditoria'); 
	}
	
}
?>
<?php
class RssModel extends Model {
	
	function exibir($tipo, $start, $limit)
	{
		$this->db->select('*');
		$this->db->from($tipo);
		$this->db->limit($limit, $start);
		$this->db->order_by('id desc, data desc');
		return $this->db->get();
	}
}
?>
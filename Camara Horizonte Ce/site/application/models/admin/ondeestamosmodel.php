<?php
class OndeEstamosModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('ondeestamos', array('id' => $id))->row_array();
	}
	
	function insert($ondeestamos)
	{
		$this->db->insert('ondeestamos', $ondeestamos);
	}
	
	function deletar($id)
	{
		$this->db->delete('ondeestamos', array('id' => $id));
	}
	
	function update($id,$ondeestamos)
	{
		$this->db->where('id', $id);
		$this->db->update('ondeestamos', $ondeestamos);
	}
	
	function getTotal() {
		return $this->db->count_all('ondeestamos');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('ondeestamos');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirSite()
	{
		$this->db->select('*');
		$this->db->from('ondeestamos');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	function emails()
	{
		$this->db->select('email, outroemail');
		$this->db->from('ondeestamos');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	
	}
}
?>
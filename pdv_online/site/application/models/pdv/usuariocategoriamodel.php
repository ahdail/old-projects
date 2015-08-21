<?php
class UsuarioCategoriaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('usuariocategoria', array('id' => $id))->row_array();
	}
	
	function insert($usuariocategoria)
	{
		$this->db->insert('usuariocategoria', $usuariocategoria);
	}
	
	function deletar($id)
	{
		$this->db->delete('usuariocategoria', array('id' => $id));
	}
	
	function update($id,$usuariocategoria)
	{
		$this->db->where('id', $id);
		$this->db->update('usuariocategoria', $usuariocategoria);
	}
	
	function getTotal() {
		return $this->db->count_all('usuariocategoria');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('usuariocategoria');
		$this->db->order_by("nomecategoria ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
}
?>
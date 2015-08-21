<?php
class NoticiaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('noticia', array('id' => $id))->row_array();
	}
	
	function insert($noticia)
	{
		$this->db->insert('noticia', $noticia);
	}
	
	function deletar($id)
	{
		$this->db->delete('noticia', array('id' => $id));
	}
	
	function update($id,$noticia)
	{
		$this->db->where('id', $id);
		$this->db->update('noticia', $noticia);
	}
	
	function getTotal() {
		return $this->db->count_all('noticia');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
}
?>
<?php
class tagModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('tag', array('id' => $id))->row_array();
	}
	
	
	function insert($secao)
	{
		$this->db->insert('tag', $secao);
		return $this->db->insert_id();
	}
	
	function deletar($id)
	{
		$this->db->delete('tag', array('id' => $id));
	}
	
	function update($id,$tag)
	{
		$this->db->where('id', $id);
		$this->db->update('tag', $tag);
	}
	
	function exibe()
	{
		return $this->db->get('tag')->result_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('tag');
		$this->db->limit($limit, $start);
		$this->db->order_by('tag ASC');
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('tag');
	}
	
	function verificaTagCadastrada($tag)
	{
		$sql = "SELECT * FROM tag where tag = '$tag'";
		$query = $this->db->query($sql);
		return $query->num_rows(); 
	}
}
?>
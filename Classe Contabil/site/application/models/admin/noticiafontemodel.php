<?php
class NoticiaFonteModel extends Model {

	function insert($fonte)
	{
		$this->db->insert('fonte', $fonte);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('fonte', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('fonte');
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();	
	}
	
	function getTotal() {
		return $this->db->count_all('fonte');
	}
	
	function deletar($id)
	{
		$this->db->delete('fonte', array('id' => $id));
	}
	
	function update($id, $fonte)
	{
		$this->db->where('id', $id);
		$this->db->update('fonte', $fonte);
	}
	
	function listarTodas()
	{
		$this->db->select('*');
		$this->db->from('fonte');
		$this->db->order_by('nomeFonte ASC');
		return $this->db->get()->result_array();	
	}

}
?>
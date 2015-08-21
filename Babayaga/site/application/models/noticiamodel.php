<?php
class NoticiaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('noticia', array('id' => $id, 'exibir' => 'N'))->row_array();
	}

	function ultimas5()
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('exibir', 'N');
		$this->db->order_by("id DESC");
		$this->db->limit(5);
		return $this->db->get()->result_array();		
	}
	
	function ultimaNoticia()
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('exibir', 'N');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();		
	}
	

}
?>
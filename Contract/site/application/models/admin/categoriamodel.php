<?php
class CategoriaModel extends CI_Model {
	
	function detalhar($id_categoria = 0) {
		return $this->db->get_where('categoria', array('id_categoria' => $id_categoria))->row_array();
	}
	
	function insert($categoria)
	{
		$this->db->insert('categoria', $categoria);
	}
	
	function deletar($id)
	{
		$this->db->delete('categoria', array('id_categoria' => $id));
	}
	
	function update($id, $categoria)
	{
		$this->db->where('id_categoria', $id);
		$this->db->update('categoria', $categoria);
	}
	
	function noticias_todas()
	{		
		$this->db->select('n.*, c.*');
		$this->db->from('noticias as n');	
		$this->db->join('categoria as c', 'n.id_categoria = c.id_categoria', 'left');	
		//$this->db->where('destaque', 'N');	
		$this->db->order_by("n.id_noticia desc, data desc");
		return $this->db->get()->result_array();	
	}
	
	
	function getTotal() {
		return $this->db->count_all('noticias');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('noticias');
		$this->db->limit($limit, $start);
		$this->db->order_by("data desc");
		return $this->db->get();
	}
	
	function categoria_todas()
	{		
		$this->db->select('*');
		$this->db->from('categoria');				
		return $this->db->get()->result_array();	
	}
	
}
?>
<?php
class NoticiaModel extends CI_Model {
	
	function detalhar($id_noticia = 0) {
		return $this->db->get_where('noticias', array('id_noticia' => $id_noticia))->row_array();
	}
	
	function insert($noticia)
	{
		$this->db->insert('noticias', $noticia);
	}
	
	function deletar($id)
	{
		$this->db->delete('noticias', array('Id' => $id));
	}
	
	function update($id, $noticia)
	{
		$this->db->where('Id', $id);
		$this->db->update('noticias', $noticia);
	}
	
	function noticia_destaque()
	{		
		$this->db->select('*');
		$this->db->from('noticias');
		$this->db->where('destaque', 'S');		
		$this->db->limit(1);
		$this->db->order_by("data desc");
		return $this->db->get()->row_array();
	
	}
	
	function noticias_todas()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->where('destaque', 'N');	
		$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function noticias_gerais()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function noticias_todas_secretaria()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->order_by("id desc");
		//$this->db->where('exibir_em', $exibir_em);
		return $this->db->get()->result_array();
	
	}
	
}
?>
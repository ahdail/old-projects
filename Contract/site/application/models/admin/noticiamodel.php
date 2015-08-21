<?php
class NoticiaModel extends CI_Model {
	
	function detalhar($id_noticia = 0) {
		return $this->db->get_where('noticias', array('id_noticia' => $id_noticia))->row_array();
	}
	
	function insert($noticia)
	{
		//print_r($noticia);
		//die();
		$this->db->insert('noticias', $noticia);
	}
	
	function deletar($id)
	{
		$this->db->delete('noticias', array('id_noticia' => $id));
	}
	
	function update($id, $noticia)
	{
		$this->db->where('id_noticia', $id);
		$this->db->update('noticias', $noticia);
	}
	
	function noticia_destaque()
	{		
		$this->db->select('*');
		$this->db->from('noticias');
		$this->db->where('destaque', 'S');
		$this->db->where('id_secretaria', '0');		
		$this->db->limit(1);
		$this->db->order_by("data DESC, id_noticia DESC");
		return $this->db->get()->row_array();
	
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
	
	function noticias_todas_site()
	{		
		$this->db->select('n.*, s.*');
		$this->db->from('noticias as n');	
		$this->db->join('secretarias as s', 'n.id_secretaria = s.id_secretaria', 'left');	
		$this->db->where('destaque !=', 'S');		
		$this->db->order_by("data DESC, id_noticia DESC");
		return $this->db->get()->result_array();	
	}
	
	function noticias_gerais()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->order_by("data DESC, id_noticia DESC");
		return $this->db->get()->result_array();	
	}
	
	function secretarias()
	{		
		$this->db->select('*');
		$this->db->from('secretarias');		
		//$this->db->where('destaque', 'N');	
		//$this->db->order_by("data desc");
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
	
	// FrontEnd
	function noticia_pag_inicial()
	{		
		$this->db->select('id_noticia, titulo, data');
		$this->db->from('noticias');		
		$this->db->order_by("id_noticia desc");
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function noticia_categoria($cat)
	{		
		$this->db->select('id_noticia, titulo, data, resumo, imagem_thumb');
		$this->db->from('noticias');	
		$this->db->where('id_categoria', $cat);			
		$this->db->order_by("id_noticia desc");
		return $this->db->get()->result_array();
	
	}
	
	function noticia_periodo($cat)
	{		
		$this->db->select('id_noticia, titulo, data, resumo, imagem_thumb');
		$this->db->from('noticias');	
		//$this->db->where('id_categoria', $cat);			
		$this->db->order_by("id_noticia desc");
		return $this->db->get()->result_array();
	
	}
}
?>
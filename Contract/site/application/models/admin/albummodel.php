<?php
class AlbumModel extends CI_Model {
	
	function detalhar($id_album = 0) {
		return $this->db->get_where('album', array('id_album' => $id_album))->row_array();
	}
	
	function insert($album)
	{
		$this->db->insert('album', $album);
	}
	
	function deletar($id)
	{
		$this->db->delete('album', array('id_album' => $id));
	}
	
	function update($id, $album)
	{
		$this->db->where('id_album', $id);
		$this->db->update('album', $album);
	}
	
	function album_todos()
	{		
		//$this->db->select('a.*, s.*');
		//$this->db->from('album as a');
		$this->db->select('*');
		$this->db->from('album');	
		//$this->db->join('secretarias as s', 'a.id_secretaria = s.id_secretaria', 'left');	
		return $this->db->get()->result_array();		
	}
	
	function album_destaque()
	{				
		$this->db->select('*');
		$this->db->from('album');	
		$this->db->order_by("id_album DESC");
		$this->db->limit('1');
		return $this->db->get()->row_array();		
	}
	
	function paginas()
	{		
		$this->db->select('*');
		$this->db->from('paginas');		
		return $this->db->get()->result_array();		
	}
	// FrontEnd
	function pagina_obra($par = false)
	{				
		$this->db->select('*');
		$this->db->from('album');	
		$this->db->where('id_pagina', '2');
		if($par){
			$this->db->where('id_categoria', $par);
		}
		$this->db->order_by("id_album DESC");
		if(!$par){
			$this->db->limit('2');
		}
		return $this->db->get()->result_array();		
	}
	// FrontEnd
	function pagina_portfolio($par = false)
	{				
		$this->db->select('*');
		$this->db->from('album');
		$this->db->where('id_pagina', '1');
		if($par){
			$this->db->where('id_categoria', $par);
		}
		$this->db->order_by("id_album DESC");
		if(!$par){
			$this->db->limit('2');
		}
		return $this->db->get()->result_array();		
	}
	
	

	
}
?>
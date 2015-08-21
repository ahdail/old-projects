<?php
class FotosModel extends CI_Model {
	
	function detalhar($id_foto = 0) {
		return $this->db->get_where('album_fotos', array('id_foto' => $id_foto))->row_array();
	}
	
	function insert($fotos)
	{
		$this->db->insert('album_fotos', $fotos);
	}
	
	function deletar($id)
	{
		$this->db->delete('album_fotos', array('id_foto' => $id));
	}
	
	function update($id, $fotos)
	{
		$this->db->where('id_foto', $id);
		$this->db->update('album_fotos', $fotos);
	}
	
	function fotos_todas()
	{		
		$this->db->select('a.id_album, a.titulo as titulo_album,  af.*');
		$this->db->from('album as a');
		$this->db->join('album_fotos as af', 'a.id_album = af.id_album');	
			
		return $this->db->get()->result_array();		
	}
	
	function fotos_album($id_album)
	{		
		$this->db->select('a.id_album, a.titulo as titulo_album,  af.*');
		$this->db->from('album as a');
		$this->db->join('album_fotos as af', 'a.id_album = af.id_album');
		$this->db->where('a.id_album', $id_album);
			
		return $this->db->get()->result_array();		
	}
	
	function album_atual($id_album)
	{		
		$this->db->select('a.id_album, a.titulo as titulo_album,  af.*');
		$this->db->from('album as a');
		$this->db->join('album_fotos as af', 'a.id_album = af.id_album');
		$this->db->where('a.id_album', $id_album);
			
		return $this->db->get()->result_array();		
	}
	
	

	
}
?>
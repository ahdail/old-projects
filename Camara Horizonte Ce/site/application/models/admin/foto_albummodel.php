<?php
class Foto_AlbumModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('album', array('id' => $id))->row_array();
	}
	
	function insert($album)
	{
		$this->db->insert('album', $album);
	}
	
	function deletar($id)
	{
		$this->db->delete('album', array('id' => $id));
	}
	
	function update($id,$album)
	{
		$this->db->where('id', $id);
		$this->db->update('album', $album);
	}
	
	function getTotal() {
		return $this->db->count_all('album');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('album');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function albummostrar($id)
	{
		$this->db->select('i.*, a.id as IdAlbum, a.nome');
		$this->db->from('album_imagem as i');
		$this->db->join('album as a', 'i.id_album = a.id');
		$this->db->where('id_album', $id);
		return $this->db->get()->result_array();
	
	}
	
	
}
?>
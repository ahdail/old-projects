<?php
class Foto_ImagemModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('album_imagem', array('id' => $id))->row_array();
	}
	
	function insert($album_imagem)
	{
		$this->db->insert('album_imagem', $album_imagem);
	}
	
	function deletar($id)
	{
		$this->db->delete('album_imagem', array('id' => $id));
	}
	
	function update($id,$album_imagem)
	{
		$this->db->where('id', $id);
		$this->db->update('album_imagem', $album_imagem);
	}
	
	function getTotal() {
		return $this->db->count_all('album_imagem');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('i.*, a.id as IdAlbum, a.nome');
		$this->db->from('album_imagem as i');
		$this->db->join('album as a', 'i.id_album = a.id');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function albuns()
	{
		$this->db->select('*');
		$this->db->from('album');		
		return $this->db->get()->result_array();
	}
	
	
}
?>
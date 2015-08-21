<?php
class VideoModel extends Model {
	
	function detalhar($id) {
		return $this->db->get_where('video', array('id' => $id))->row_array();
	}
	
	function insert($video)
	{
		$this->db->insert('video', $video);
	}
	
	function deletar($id)
	{
		$this->db->delete('video', array('id' => $id));
	}
	
	function update($idConteudo,$video)
	{
		$this->db->where('id', $idConteudo);
		$this->db->update('video', $video);
	}
	
	function getTotal() {
		return $this->db->count_all('video');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->order_by("id desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}

	function ultimoVideo () 
	{
		$this->db->select('*');
		$this->db->from('video');		
		$this->db->order_by("id desc");
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
	function todosVideos()
	{
		$this->db->select('id, titulo, descricao, fotoVideoThumb');
		$this->db->from('video');	
		$this->db->order_by("id DESC");
		return $this->db->get()->result_array();
	}
	
	function videoAtual()
	{
		$this->db->select('id, nomecolecao');
		$this->db->from('video');	
		$this->db->order_by("id DESC");
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
}
?>
<?php
class VideoModel extends Model {
	
	function exibirVideo()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('exibir', "S");
		$this->db->limit(4);
		$this->db->order_by('id desc');
		return $this->db->get()->result_array();
	}
	
	function exibirVideoDestaque()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('destaque', "S");
		return $this->db->get()->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->select("
		video.*,
		(SELECT count(*) FROM video_comentario WHERE idVideo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('video');
		$this->db->limit($limit, $start);
		$this->db->order_by('id desc');
		$this->db->where('exibir', "S");
		return $this->db->get()->result_array();
	}
	
	function ver($id = 0) 
	{
		return $this->db->get_where('video', array('id' => $id))->row_array();
	}
	
	function getTotal() {
		return $this->db->count_all('video');
	}
	// incrementa +1 a qtd de acesso
	function contador($id)
	{
		$this->db->query("UPDATE video SET acesso = acesso + 1 WHERE id = {$id}");
	}
	
	function maisAcessados()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->order_by('acesso desc');
		$this->db->where('exibir', "S");
		$this->db->limit(4);
		return $this->db->get()->result_array();
	}
	
	function exibirComentarios($id)
	{
		$this->db->select('*');
		$this->db->from('video_comentario');
		$filtro = array('autorizado' => "S", 'idVideo' => $id);
		$this->db->where($filtro);
		$this->db->order_by('idComentario DESC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function comentarVideo($dados) 
	{
		$this->db->insert('video_comentario', $dados);
	}
}
?>
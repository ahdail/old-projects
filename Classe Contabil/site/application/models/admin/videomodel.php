<?php
class VideoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('video', array('id' => $id))->row_array();
	}
	
	function comentarioDetalhar($id = 0) {
		return $this->db->get_where('video_comentario', array('idComentario' => $id))->row_array();
	}
	
	function insert($video)
	{
		$this->db->insert('video', $video);
		$idVideo = $this->db->insert_id();
		return $idVideo;
	}
	
	function deletar($id)
	{
		$this->db->delete('video', array('id' => $id));
	}
	
	function comentarioDeletar($id)
	{
		$this->db->delete('video_comentario', array('idComentario' => $id));
	}
	
	function update($id,$video)
	{
		$this->db->where('id', $id);
		$this->db->update('video', $video);
	}
	
	function updateComentario($id,$video)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('video_comentario', $video);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->limit($limit, $start);
		$this->db->order_by("id desc");
		return $this->db->get();
	}
	
	
	function getTotal() {
		return $this->db->count_all('video');
	}
	function opcao($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('video', $exibe);
	}
	
	function exibirComentario($start, $limit)
	{
		$this->db->select('*,v.titulo as titulo');
		$this->db->from('video_comentario as vc');
		$this->db->join('video as v', 'v.id  = vc.idVideo','left');
		$this->db->limit($limit, $start);
		$this->db->order_by("vc.idComentario desc");
		return $this->db->get();
	}
	
	function getTotalComentario() {
		return $this->db->count_all('video_comentario');
	}
	
	
	function opcaoComentario($id,$exibe)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('video_comentario', $exibe);
	}
	
	function exibirVideo($idVideo)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('id', $idVideo);
		$this->db->order_by("id desc");
		return $this->db->get()->result_array();
	}
	
	function exibirVideoSite()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('exibir', "S");
		$this->db->order_by("id desc");
		return $this->db->get()->result_array();
	}
	
	function verificaImagem($id) {
		$this->db->select('icoDestaque');
		$this->db->where('id', $id); 
		return $this->db->get('video')->row_array();
	}
}
?>
<?php
class PodClasseModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('podclasse', array('id' => $id))->row_array();
	}
	
	function comentarioDetalhar($id = 0) {
		return $this->db->get_where('pod_comentario', array('idComentario' => $id))->row_array();
	}
	
	function insert($podClasse)
	{
		$this->db->insert('podclasse', $podClasse);
		$idPodClasse = $this->db->insert_id();
		return $idPodClasse;
	}
	
	
	
	function deletar($id)
	{
		$this->db->delete('podclasse', array('id' => $id));
	}
	
	function comentarioDeletar($id)
	{
		$this->db->delete('pod_comentario', array('idComentario' => $id));
	}
	
	function update($id,$podclasse)
	{
		$this->db->where('id', $id);
		$this->db->update('podclasse', $podclasse);
	}
	
	function updateComentario($id,$video)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('pod_comentario', $video);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('podclasse');
		$this->db->limit($limit, $start);
		$this->db->order_by("id desc");
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('podclasse');
	}
	
	function opcao($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('podclasse', $exibe);
	}
	
	function exibirPodClasse($idPodClasse)
	{
		$this->db->select('*');
		$this->db->from('podclasse');
		$this->db->where('id', $idpodclasse);
		$this->db->order_by("id desc");
		return $this->db->get()->result_array();
	}
	
	function exibirpodclasseSite()
	{
		$this->db->select('*');
		$this->db->from('podclasse');
		$this->db->where('exibir', "S");
		$this->db->order_by("id desc");
		return $this->db->get()->result_array();
	}
	
	function ver($id) {
		return $this->db->get_where('podclasse', array('id' => $id))->row_array();
	}
	
	function exibirComentario($start, $limit)
	{
		$this->db->select('*,p.titulo as titulo');
		$this->db->from('pod_comentario as pc');
		$this->db->join('podclasse as p', 'p.id  = pc.idPod','left');
		$this->db->limit($limit, $start);
		$this->db->order_by("pc.idComentario desc");
		return $this->db->get();
	}
	
	function getTotalComentario() {
		return $this->db->count_all('pod_comentario');
	}
	
	
	function opcaoComentario($id,$exibe)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('pod_comentario', $exibe);
	}
}
?>
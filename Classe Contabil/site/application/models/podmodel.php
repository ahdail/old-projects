<?php
class PodModel extends Model {
	
	
	function exibirPodClasse()
	{
		$this->db->select('*');
		$this->db->from('podclasse');
		$this->db->where('exibir', "S");
		$this->db->limit(4);
		$this->db->order_by('id desc');
		return $this->db->get()->result_array();
	}
	
	
	function exibir($start, $limit)
	{
		$this->db->select("
		podclasse.*,
		(SELECT count(*) FROM pod_comentario WHERE idPod = id and autorizado = 'S') as comentarios
		");
		$this->db->from('podclasse');
		$this->db->limit($limit, $start);
		$this->db->where('exibir', "S");
		$this->db->order_by('id desc');
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('podclasse');
	}
	
	function ver($id = 0) 
	{
		return $this->db->get_where('podclasse', array('id' => $id))->row_array();
	}
	
	function contador($id)
	{
		$this->db->query("UPDATE podclasse SET acesso = acesso + 1 WHERE id = {$id}");
	}
	
	function maisAcessados()
	{
		$this->db->select('*');
		$this->db->from('podclasse');
		$this->db->order_by('acesso desc');
		$this->db->limit(4);
		return $this->db->get()->result_array();
	}
	
	function exibirComentarios($id)
	{
		$this->db->select('*');
		$this->db->from('pod_comentario');
		$filtro = array('autorizado' => "S", 'idVideo' => $id);
		$this->db->where($filtro);
		$this->db->order_by('idComentario DESC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function comentarVideo($dados) 
	{
		$this->db->insert('pod_comentario', $dados);
	}

	function exibirComentario($start, $limit)
	{
		$this->db->select('*,p.titulo as titulo');
		$this->db->from('pod_comentario as pc');
		$this->db->join('podclasse as p', 'p.id  = pc.idVideo','left');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotalComentario() {
		return $this->db->count_all('pod_comentario');
	}
	
	function comentarPod($dados) 
	{
		$this->db->insert('pod_comentario', $dados);
	}

}


?>
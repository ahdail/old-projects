<?php
class NeoModel extends Model
{
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('neo');
		$this->db->limit($limit, $start);
		$this->db->order_by('id desc, data desc');
		return $this->db->get();
	}
	
	function ver($id = 0) 
	{
		return $this->db->get_where('neo', array('id' => $id))->row_array();
	}
	
	function getTotal() {
		return $this->db->count_all('neo');
	}
	
	// incrementa +1 a qtd de acesso
	function update($id)
	{
		$this->db->query("UPDATE neo SET acesso = acesso + 1 WHERE id = {$id}");
	}
	
	function exibirComentarios($id)
	{
		$this->db->select('*');
		$this->db->from('neo_comentario');
		$filtro = array('autorizado' => "S", 'idNeo' => $id);
		$this->db->where($filtro);
		$this->db->order_by('idComentario ASC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function ultimas3($id)
	{
		$this->db->select('*');
		$this->db->from('neo');
		$filtro = array('id !=' => $id);
		$this->db->where($filtro);
		$this->db->order_by('id desc, data desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}

	function comentarNeo($comentar) 
	{
		$this->db->insert('neo_comentario', $comentar);
	}
	
}
?>
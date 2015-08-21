<?php
class VozCidadaoModel extends Model {
	
	function detalhar($id) {
		return $this->db->get_where('vozcidadao', array('id' => $id))->row_array();
	}
	
	function insert($vozcidadao)
	{
		$this->db->insert('vozcidadao', $vozcidadao);
	}
	
	function deletar($id)
	{
		$this->db->delete('vozcidadao', array('id' => $id));
	}
	
	function update($idConteudo,$vozcidadao)
	{
		$this->db->where('id', $idConteudo);
		$this->db->update('vozcidadao', $vozcidadao);
	}
	
	function getTotal() {
		return $this->db->count_all('vozcidadao');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('v.*, a.id as IdAssunto, a.assunto as assunto');
		$this->db->from('vozcidadao as v');
		$this->db->join('assunto as a', 'v.id_assunto = a.id');
		$this->db->order_by("id desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}

	function vozcidadaoSite()
	{
		$this->db->select('*');
		$this->db->from('vozcidadao');	
		$this->db->where('mostrar', "S");
		$this->db->order_by("id DESC");
		return $this->db->get()->result_array();
	}

}
?>
<?php
class ConteudoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('conteudo', array('id' => $id))->row_array();
	}
	
	function insert($conteudo)
	{
		$this->db->insert('conteudo', $conteudo);
		$idConteudo = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirTitulo($id = 0)
	{
		$this->db->select('titulo');
		return $this->db->get_where('conteudo', array('id' => $id))->row_array();
	}
	
	function getTotal() {
		return $this->db->count_all('conteudo');
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('conteudo', array('id' => $id))->row_array();
	}
	
	function deletar($id)
	{
		$this->db->delete('conteudo', array('id' => $id));
	}
	
	function update ($id, $conteudo)
	{
		$this->db->where('id', $id);
		$this->db->update('conteudo', $conteudo);
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('conteudo', $exibe);
	}

}
?>
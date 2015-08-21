<?php
class DepoimentosModel extends Model {

	// Insert do portal
	function insert($depoimentos)
	{
		$this->db->insert('depoimentos', $depoimentos);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('depoimentos', array('id' => $id))->row_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirPortal($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->order_by("id DESC");
		$this->db->where('autorizado', "S");
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirDepoimentosPortal()
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->where('autorizado', "S");
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();	
	}
	
	function getMax() {
		$query = $this->db->query("select count(id) as qtd from depoimentos;");
		return $query->result_array();
	}
	
	function getTotal() {
		return $this->db->count_all('depoimentos');
	}
	
	function deletar($id)
	{
		$this->db->delete('depoimentos', array('id' => $id));
	}
	
	function update($id, $depoimentos)
	{
		$this->db->where('id', $id);
		$this->db->update('depoimentos', $depoimentos);
	}
	
	function exibirAguardandoAutorizacao($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->order_by("id DESC");
		$this->db->where('autorizado', "A");
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirAutorizado($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->order_by("id DESC");
		$this->db->where('autorizado', "S");
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function exibirNaoAutorizado($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('depoimentos');
		$this->db->order_by("id DESC");
		$this->db->where('autorizado', "N");
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}

}
?>
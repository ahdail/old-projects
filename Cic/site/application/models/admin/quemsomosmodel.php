<?php
class QuemSomosModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('quem_somos', array('id' => $id))->row_array();
	}
	
	function insert($quemsomos)
	{
		$this->db->insert('quem_somos', $quemsomos);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('quem_somos');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('quem_somos');
	}
	
	function deletar($id)
	{
		$this->db->delete('quem_somos', array('id' => $id));
	}
	
	function update ($id, $quemsomos)
	{
		$this->db->where('id', $id);
		$this->db->update('quem_somos', $quemsomos);
	}
	
	function exibirQuemSomosSite()
	{
		$this->db->select('quemSomos');
		$this->db->from('quem_somos');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	
	function exibirDiretoriaSite()
	{
		$this->db->select('diretoria');
		$this->db->from('quem_somos');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	
	function exibirPresidenteSite()
	{
		$this->db->select('nomePresidente, descricaoPresidente,fotoPresidente');
		$this->db->from('quem_somos');
		$this->db->order_by("id DESC");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

}
?>
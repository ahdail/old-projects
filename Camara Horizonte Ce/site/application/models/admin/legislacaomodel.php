<?php
class LegislacaoModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('legislacao', array('id' => $id))->row_array();
	}
	
	function insert($legislacao)
	{
		$this->db->insert('legislacao', $legislacao);
	}
	
	function deletar($id)
	{
		$this->db->delete('legislacao', array('id' => $id));
	}
	
	function update($id,$legislacao)
	{
		$this->db->where('id', $id);
		$this->db->update('legislacao', $legislacao);
	}
	
	function getTotal() {
		return $this->db->count_all('legislacao');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('legislacao');		
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();
		
	}
	
	
	function partidos()
	{
		$this->db->select('*');
		$this->db->from('partido');
		
		return $this->db->get()->result_array();
	}
	
	function exibirSite()
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('legislacao as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');		
		$this->db->order_by('presidente DESC, id DESC');
		return $this->db->get()->result_array();
		
	}
	
	function ver($id = 0)
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('legislacao as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->where('v.id', $id);
		
		return $this->db->get()->row_array();
		
	}
	
	function legislacao()
	{
		$this->db->select('*');
		$this->db->from('legislacao');
		$this->db->where('exibir_em', "leg");
		return $this->db->get()->result_array();
	}
	
	function leimunicipal()
	{
		$this->db->select('*');
		$this->db->from('legislacao');
		$this->db->where('exibir_em', "lei");
		return $this->db->get()->result_array();
	}
	
}
?>
<?php
class VereadoresModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('vereadores', array('id' => $id))->row_array();
	}
	
	function insert($vereadores)
	{
		$this->db->insert('vereadores', $vereadores);
	}
	
	function deletar($id)
	{
		$this->db->delete('vereadores', array('id' => $id));
	}
	
	function update($id,$vereadores)
	{
		$this->db->where('id', $id);
		$this->db->update('vereadores', $vereadores);
	}
	
	function getTotal() {
		return $this->db->count_all('vereadores');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('vereadores as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->limit($limit, $start);
		$this->db->order_by('presidente DESC, id DESC');
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
		$this->db->from('vereadores as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');		
		$this->db->order_by('presidente DESC, id DESC');
		return $this->db->get()->result_array();
		
	}
	
	function ver($id = 0)
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('vereadores as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->where('v.id', $id);
		
		return $this->db->get()->row_array();
		
	}
	
	function mesadiretora()
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('vereadores as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->where('mesa_diretora', "S");
		$this->db->order_by('presidente DESC, id DESC');
		return $this->db->get()->result_array();
		
	}
	
	function presidente()
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('vereadores as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->where('presidente', "S");
		$this->db->limit(1);
		
		return $this->db->get()->row_array();
		
	}
	
	function assunto()
	{
		$this->db->select('*');
		$this->db->from('assunto');
		return $this->db->get()->result_array();		
	}
	
	
	
}
?>
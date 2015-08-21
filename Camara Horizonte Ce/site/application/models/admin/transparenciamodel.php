<?php
class TransparenciaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('portaltransparencia', array('id' => $id))->row_array();
	}
	
	function insert($portaltransparencia)
	{
		$this->db->insert('portaltransparencia', $portaltransparencia);
	}
	
	function deletar($id)
	{
		$this->db->delete('portaltransparencia', array('id' => $id));
	}
	
	function update($id,$portaltransparencia)
	{
		$this->db->where('id', $id);
		$this->db->update('portaltransparencia', $portaltransparencia);
	}
	
	function getTotal() {
		return $this->db->count_all('portaltransparencia');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('portaltransparencia');		
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();
		
	}
	
	
	
	function ver($id = 0)
	{
		$this->db->select('v.*, p.id as IdPartido, p.nome as nome_partido');
		$this->db->from('portaltransparencia as v');
		$this->db->join('partido as p', 'v.id_partido = p.id');
		$this->db->where('v.id', $id);
		
		return $this->db->get()->row_array();
		
	}
	
	function exibirsite()
	{
		$this->db->select('*');
		$this->db->from('portaltransparencia');
		$this->db->where('exibir_em', "lei");
		return $this->db->get()->result_array();
	}
	
}
?>
<?php
class NovaPaginaModel extends Model {
	
	function detalhar($id) {
		return $this->db->get_where('nova_pagina', array('id' => $id))->row_array();
	}
	
	function insert($novapagina)
	{
		$this->db->insert('nova_pagina', $novapagina);
	}
	
	function deletar($id)
	{
		$this->db->delete('nova_pagina', array('id' => $id));
	}
	
	function update($idPagina,$novapagina)
	{
		$this->db->where('id', $idPagina);
		$this->db->update('nova_pagina', $novapagina);
	}
	
	function getTotal() {
		return $this->db->count_all('nova_pagina');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('nova_pagina');
		//$this->db->order_by("data desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
	function menu() 
	{
		$this->db->select('*');
		$this->db->from('nova_pagina');
		
		return $this->db->get()->result_array();
	}
	
	function conteudo($id) {
		return $this->db->get_where('nova_pagina', array('id' => $id))->result_array();
	}
}
?>
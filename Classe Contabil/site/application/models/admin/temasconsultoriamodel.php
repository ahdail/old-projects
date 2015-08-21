<?php
class TemasConsultoriaModel extends Model {

	function insert($temas)
	{
		$this->db->insert('consultoria_temas', $temas);
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('consultoria_temas', array('id' => $id))->row_array();
	}
	
	function listar() 
	{
		return $this->db->get('consultoria_temas')->result_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('consultoria_temas');
		$this->db->limit($limit, $start);
		return $this->db->get();	
	}
	
	function getTotal() {
		return $this->db->count_all('consultoria_temas');
	}
	
	function deletar($id)
	{
		$this->db->delete('consultoria_temas', array('id' => $id));
	}
	
	function update($id, $temas)
	{
		$this->db->where('id', $id);
		$this->db->update('consultoria_temas', $temas);
	}
	
	function updateTemas($idUsuario, $temas)
	{
		$this->db->insert('consultoria_temas_consultor', array('idUsuario' => $idUsuario, 'idTema' => $temas));
	}
	
	function deletaTemas($idUsuario)
	{
		$this->db->where('idUsuario', $idUsuario);
		$this->db->delete('consultoria_temas_consultor');
	}
	
	function temas() 
	{
		$this->db->select('*');
		$this->db->from('consultoria_temas');
		$this->db->order_by('tema');
		return $this->db->get()->result_array();
	}
	
	function temasConsultor($idUsuario){
		return $this->db->get_where('consultoria_temas_consultor', array('idUsuario' => $idUsuario))->result_array();
	}
	

}
?>
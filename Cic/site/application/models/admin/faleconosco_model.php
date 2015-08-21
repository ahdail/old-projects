<?php
class Faleconosco_model extends Model
{
	// MANIPULAÇÃO DAS FUNCOES DO FALE CONOSCO
	function listarTodos($inicio=false, $limite=false)
	{
		$this->db->select('*');
		$this->db->from('funcao');
		$this->db->orderby('ordem');
		if ($inicio and $limite) $this->db->limit($inicio, $limite);
		return $this->db->get()->result_array();
	}
	
	// Lista uma funcao especifica
	function listarUm($idFuncao)
	{
		$this->db->select('*');
		$this->db->from('funcao');
		$this->db->where('id', $idFuncao);
		return $this->db->get()->row_array();
	}
	
	function listarTotal()
	{
		return $this->db->count_all('funcao');
	}
	
	function inserir($array)
	{
		$this->db->insert('funcao', $array);
		$idFuncao = $this->db->insert_id();
		return $idFuncao;
	}
	
	function editar($idFuncao, $array)
	{
		$this->db->where('id', $idFuncao);
		return $this->db->update('funcao', $array);
	}
	
	function deletar($idFuncao)
	{
		return $this->db->delete('funcao', array('id' => $idFuncao));
	}
}
?>
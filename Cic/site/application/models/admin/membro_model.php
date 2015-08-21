<?php
class Membro_model extends Model
{
	function listarTodos($inicio, $limite)
	{
		$this->db->select('membro.id, membro.nome as nomeMembro, membro.email, funcao.nome as nomeFuncao');
		$this->db->from('membro');
		$this->db->join('funcao','funcao.id = membro.idFuncao','left');
		$this->db->limit($inicio, $limite);
		return $this->db->get()->result_array();
	}
	
	function listarUm($idMembro)
	{
		$this->db->select('*');
		$this->db->from('membro');
		$this->db->where('id', $idMembro);

		return $this->db->get()->row_array();
	}
		
	function listarTotal()
	{
		return $this->db->count_all('membro');
	}
		
	function inserir($array)
	{
		$this->db->insert('membro', $array);
		$idMembro = $this->db->insert_id();
		return $idMembro;
	}
	
	function editar($idMembro, $array)
	{
		$this->db->where('id', $idMembro);
		return $this->db->update('membro', $array);
	}
	
	function deletar($idMembro)
	{
		return $this->db->delete('membro', array('id' => $idMembro));
	}
}
?>
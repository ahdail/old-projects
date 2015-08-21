<?php
class CidadeModel extends Model
{
	
	function getAll()
	{
		$this->db->select("*");
		$this->db->from("mun");
		$this->db->order_by("UFD_SIGLA ASC");
		return $this->db->get()->result_array();
	}
	
	function getPorEstado($estado)
	{
		$this->db->select("CODIGO, NOME");
		$this->db->from("mun");
		$this->db->where("UFD_SIGLA", $estado);
		$this->db->order_by("NOME");
		return $this->db->get()->result_array();
	}
	
	/*function getOne($idUsuario)
	{
		$this->db->select("usuarios_classe.estado");
		$this->db->from("usuarios_classe");
		$this->db->join('estado', 'estado.sigla = usuarios_classe.estado','left');
		$this->db->where('usuarios_classe.id', $idUsuario);
		return $this->db->get()->row_array();
	}*/
}

?>
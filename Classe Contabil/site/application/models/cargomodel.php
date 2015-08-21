<?php
class CargoModel extends Model
{
	
	function getAll()
	{
		$this->db->select("*");
		$this->db->from("cargo");
		$this->db->order_by("nome ASC");
		return $this->db->get()->result_array();
	}
	
	function getOne($idUsuario)
	{
		$this->db->select("usuarios_classe.idOcupacao");
		$this->db->from("cargo");
		$this->db->join('usuarios_classe', 'cargo.id  = usuarios_classe.idOcupacao','left');
		$this->db->where('usuarios_classe.id', $idUsuario);
		return $this->db->get()->row_array();
	}
}

?>
<?php
class LoginModel extends Model {
	
	function loginPermissao($idPerfil)
	{
		$this->db->select('idPermissao');
		$this->db->from('permissao_perfil');
		$this->db->where($idPerfil); 
		return $this->db->get()->row_array();
	}
	
	function codigoPermissao($idPermissao){
		$this->db->select('codigo');
		$this->db->from('permissao');
		$this->db->where($idPermissao); 
		return $this->db->get()->row_array();
	}

}
?>
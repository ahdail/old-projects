<?php
class UsuarioDadosModel extends Model {

	function detalhar($login) 
	{
		return $this->db->get_where('usuario', array('login' => $login))->row_array();
	}

	function update($login,$usuario)
	{
		$this->db->where('login', $login);
		$this->db->update('usuario', $usuario);
	}
}
?>
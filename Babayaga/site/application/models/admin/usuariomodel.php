<?php
class UsuarioModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('usuario', array('id' => $id))->row_array();
	}
	
	function insert($usuario)
	{
		$this->db->insert('usuario', $usuario);
	}
	
	function exibirPerfil()
	{
		$this->db->select('perfil,id');
		$this->db->from('perfil');
		return $this->db->get()->result_array();
	}
	
	function deletar($id)
	{
		$this->db->delete('usuario', array('id' => $id));
	}
	
	function update($id,$usuario)
	{
		$this->db->where('id', $id);
		$this->db->update('usuario', $usuario);
	}
	
	
/**
	function exibir($start, $limit)
	{
		$this->db->select('perfil.perfil as perfilNome, usuario.nome as usuarioNome, usuario.login,usuario.id as idUsuario');
		$this->db->from('perfil');
		$this->db->join('usuario', 'perfil.id  = usuario.idPerfil','inner');
		$this->db->order_by("usuario.id desc1");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	**/	
	function exibir($start, $limit)
	{
		$this->db->select('id, nome, login');
		$this->db->from('usuario');
		//$this->db->join('usuario', 'perfil.id  = usuario.idPerfil','inner');
		$this->db->order_by("nome asc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('usuario');
	}
	// Verifica se já existe um login cadastrado no banco
	function verificaLogin($login)
	{
		$this->db->select('login');
		$this->db->from('usuario');
		$this->db->where('login', $login);
		return $this->db->count_all_results();
	}
	// Validar os dados do usuário para acessar a administrção 
	function validaLogin($login)
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where($login); 
		return $this->db->get()->row_array();
	}
	
}
?>
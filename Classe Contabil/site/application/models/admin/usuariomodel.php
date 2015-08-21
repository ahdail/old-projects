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
	function exibirPerfilCadastro()
	{
		$this->db->select('nome,id');
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
	/*
	function exibir()
	{
		$this->db->select('perfil.nome as perfilNome, usuario.nome as usuarioNome,usuario.id as id');
		$this->db->from('perfil');
		$this->db->join('usuario', 'perfil.id  = usuario.idPerfil','inner');
		return $this->db->get()->result_array();
	}
	*/
	function exibir($start, $limit)
	{
		$this->db->select('perfil.nome as perfilNome, usuario.nome as usuarioNome,usuario.id as id');
		$this->db->from('perfil');
		$this->db->join('usuario', 'perfil.id  = usuario.idPerfil','inner');
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
	
	function exibirPerfil($idPerfil)
	{
		$this->db->select('secao.codigo');
		$this->db->from('secao');
		$this->db->join('secao_perfil', 'secao.id  = secao_perfil.idSecao','left');
		$this->db->where('idPerfil', $idPerfil);
		return $this->db->get()->result_array();
	}
	
}
?>
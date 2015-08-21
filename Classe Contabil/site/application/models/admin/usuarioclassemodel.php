<?php
class UsuarioClasseModel extends Model {

	function detalhar($id) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->row_array();
	}
	
	function insert($usuarioClasse)
	{
		$this->db->insert('usuarios_classe', $usuarioClasse);
	}
	
	function filtroEmail($email){
		
		return $this->db->get_where('usuarios_classe', array('email' => $email))->result_array();
	}
	
	function deletar($id)
	{
		$this->db->delete('usuarios_classe', array('id' => $id));
	}
	
	function update($id, $usuarioClasse)
	{
		
		$this->db->where('id', $id);
		$this->db->update('usuarios_classe', $usuarioClasse);
		
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('usuarios_classe');
	}
	
}
?>
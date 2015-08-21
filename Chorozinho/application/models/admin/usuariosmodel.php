<?php
class UsuariosModel extends CI_Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('PROJETO_EQUIPE_USUARIO', array('Id' => $id))->row_array();
	}
	
	function insert($usuario)
	{
		$this->db->insert('PROJETO_EQUIPE_USUARIO', $usuario);
	}
	
	function deletar($id)
	{
		$this->db->delete('PROJETO_EQUIPE_USUARIO', array('Id' => $id));
	}
	
	function update($id, $usuario)
	{
		$this->db->where('Id', $id);
		$this->db->update('PROJETO_EQUIPE_USUARIO', $usuario);
	}
	
	
	function usuarios_todos()
	{
		
		$this->db->select('*');
		$this->db->from('PROJETO_EQUIPE_USUARIO');
		//$this->db->where('ID_PROJETO_REPORT');
		//$this->db->where('TIPO_ATIVIDADES','P');
		//$this->db->limit(3);
		$this->db->order_by("id DESC");
		return $this->db->get()->result_array();
	
	}
	
	function projetos()
	{
		
		$this->db->select('*');
		$this->db->from('PROJETO');
		//$this->db->where('ID_PROJETO_REPORT');
		//$this->db->where('TIPO_ATIVIDADES','P');
		//$this->db->limit(3);
		$this->db->order_by("ID_PROJETO DESC");
		return $this->db->get()->result_array();
	
	}
	
}
?>
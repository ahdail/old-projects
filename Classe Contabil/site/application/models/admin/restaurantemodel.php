<?php
class RestauranteModel extends Model {

	function detalhar($id = 0) 
	{
		$this->db->select('artigo.*, usuarios_classe.nome, usuarios_classe.email', false);
		$this->db->from('artigo');
		$this->db->join('usuarios_classe', 'artigo.idUsuarios = usuarios_classe.id', 'left');
		$this->db->where('artigo.id', $id);
		return $this->db->get()->row_array();
	}
	
	
	function insert($artigo)
	{
		$this->db->insert('artigo', $artigo);
	}
	
	function insertAutor($autor)
	{
		$this->db->insert('autor', $autor);
		return $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('artigo');
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('artigo');
	}
	
	// Filtro de autores
	function exibirFiltro($start, $limit, $idAutor)
	{
		$this->db->select('*');
		$this->db->from('artigo');
		$this->db->where('idAutores', $idAutor);
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();
	}
	function getTotalFiltro() {
		
		return $this->db->count_all('artigo', "idAutores = $idAutor" );
	}
	/* fim filtro */
	
	function deletar($id)
	{
		$this->db->delete('artigo', array('id' => $id));
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('artigo', array('id' => $id))->row_array();
	}
	
	function update($id, $artigo)
	{
		$this->db->where('id', $id);
		$this->db->update('artigo', $artigo);
	}
	
	function updateUsuario($idUsuario, $campos)
	{
		$this->db->where('id', $idUsuario);
		$this->db->update('usuarios_classe', $campos);
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('artigo', $exibe);
	}

}
?>
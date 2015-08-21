<?php
class AutoresModel extends Model {
	
	function ver($id = 0) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->result_array();
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->row_array();
	}
	
	function verAutores($start, $limit)
	{
		$query = $this->db->query("	
			SELECT art. * , aut.nome, aut.curriculoResumido, aut.email
			FROM artigo AS art
			JOIN autor AS aut ON art.idAutores = aut.id
			WHERE nome != 'null'
			ORDER BY `aut`.`nome` ASC
			LIMIT $limit, $start
		");
		
		return $query->result_array();
	}
	
	function verAutor($id){
		$query = $this->db->query("	
			SELECT art.id, art.titulo, art.data, art.resumo, art.acesso, art.tipo, art.idAutores, aut.nome, aut.email
			FROM artigo AS art
			JOIN autor AS aut ON art.idAutores = aut.id
			WHERE nome != 'null' and art.idAutores = '$id' 
			GROUP BY art.titulo
			ORDER BY art.data DESC
		");
		return $query->result_array();
	}
	
	function qtdArtigo($id) 
	{
		$query = $this->db->query("
			SELECT 
				count( * )FROM artigo
			WHERE 
				idAutores = '$id' AND tipo = 'A'
		");
		return $query->row_array();
	}
	
	function exibir($letra) 
	{
		$this->db->select('*');
		$this->db->from('consultores');
		$this->db->like('palavra', $letra, 'after'); 
		return $this->db->get()->result_array();
	}
	
	function buscar($letra) 
	{
		$query = $this->db->query("	
			SELECT art.id, art.titulo, art.data, art.resumo, art.acesso, art.tipo, art.idAutores, aut.nome, aut.email,
			(SELECT count(*) FROM artigo as subArtigo WHERE subArtigo.idAutores = art.idAutores) as qtdArtigos
			FROM artigo AS art
			JOIN autor AS aut ON art.idAutores = aut.id
			WHERE nome != 'null' AND nome
			LIKE '$letra%'
			GROUP BY art.titulo
			ORDER BY aut.nome ASC  
		");
		
		return $query->result_array();
	}
	
	function buscarAutor($search) 
	{
		$query = $this->db->query("	
			SELECT art. * , aut.nome, aut.curriculoResumido, aut.email
			FROM artigo AS art
			JOIN autor AS aut ON art.idAutores = aut.id
			WHERE nome != 'null' and nome LIKE '%$search%' 
			GROUP BY art.titulo
			ORDER BY aut.nome ASC
			LIMIT 1
		");
		
		return $query->result_array();
	}
	
	function listarTodos()
	{
		$query = $this->db->query("	
			SELECT art. * , aut.nome, aut.curriculoResumido, aut.email
			FROM artigo AS art
			JOIN autor AS aut ON art.idAutores = aut.id
			WHERE nome != 'null'
			GROUP BY art.idAutores
			ORDER BY aut.nome ASC
		");
		
		return $query->result_array();
	}
	
}
?>
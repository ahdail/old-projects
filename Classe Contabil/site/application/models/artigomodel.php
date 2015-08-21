<?php
class ArtigoModel extends Model {
		
	function exibirPrincipal()
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$this->db->where('exibirPrincipal =', "S");
		$this->db->where('tipo !=', "J");
		$this->db->where('tipo !=', "D");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('data desc, id desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function exibirDestaque()
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$this->db->where('exibirDestaque', "S");
		$this->db->where('tipo !=', "J");
		$this->db->where('tipo !=', "D");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('id desc, data desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function exibirJuizo()
	{
		$this->db->select('*');
		$this->db->from('artigo');
		$this->db->where('tipo', "J");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('id desc, data desc');
		return $this->db->get()->result_array();
	}
	
	function exibirJuizoDestaque()
	{
		$this->db->select('*');
		$this->db->from('artigo');
		$this->db->where('tipo', "J");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function exibirDireito()
	{
		$this->db->select('*');
		$this->db->from('artigo');
		$this->db->where('tipo', "D");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('id desc, data desc');
		return $this->db->get()->result_array();
	}
	
	function exibirDireitoDestaque()
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$this->db->where('tipo', "D");
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function ultimos3Artigos($id)
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$filtro = array('exibirPrincipal' => "S", 'id !=' => $id, "bloqueado =" => 0);
		$this->db->where($filtro);
		$this->db->order_by('data desc, id desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$this->db->where('tipo', "A");
		$this->db->where('tipo !=', "D");
		$this->db->where('bloqueado =', 0);
		$this->db->limit($limit, $start);
		$this->db->order_by('data desc, id desc');
		return $this->db->get();
	}
	
	function ver($id = 0) 
	{
		return $this->db->get_where('artigo', array('id' => $id))->row_array();
	}
	
	function nomeAutor($id)
	{
		$this->db->select('au.nome as nome,au.curriculoResumido as curriculoResumido');
		$this->db->from('artigo as ar');
		$this->db->join('autor as au', 'au.id = ar.idAutores ', 'left');
		$this->db->where('ar.id', $id); 
		return $this->db->get()->row_array(); 
		
	}
	
	function getTotal() {
		return $this->db->count_all('artigo');
	}
	// incrementa +1 a qtd de acesso
	function update($id)
	{
		$this->db->query("UPDATE artigo SET acesso = acesso + 1 WHERE id = {$id}");
	}
	
	function maisAcessados()
	{
		$this->db->select("
		artigo.*,
		(SELECT count(*) FROM artigo_comentario WHERE idArtigo = id and autorizado = 'S') as comentarios
		");
		$this->db->from('artigo');
		$this->db->where('bloqueado =', 0);
		$this->db->order_by('acesso desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function exibirComentarios($id)
	{
		$this->db->select('*');
		$this->db->from('artigo_comentario');
		$filtro = array('autorizado' => "S", 'idArtigo' => $id);
		$this->db->where($filtro);
		$this->db->order_by('idComentario DESC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	
	function comentarArtigo($comentar) 
	{
		$this->db->insert('artigo_comentario', $comentar);
	}
	
}
?>
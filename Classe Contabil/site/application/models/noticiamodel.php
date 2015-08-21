<?php
class NoticiaModel extends Model {
		
	function exibirPrincipal()
	{
		$this->db->select("
		noticia.*,
		(SELECT count(*) FROM noticia_comentario WHERE idNoticia = id and autorizado = 'S') as comentarios
		");
		$this->db->from('noticia');
		$this->db->where('exibirDestaque !=', "S");
		$this->db->where('exibirPrincipal =', "S");
		$this->db->order_by('data desc, id desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function exibirDestaque()
	{
		$this->db->select("
		noticia.*,
		(SELECT count(*) FROM noticia_comentario WHERE idNoticia = id and autorizado = 'S') as comentarios
		");
		$this->db->from('noticia');
		$this->db->where('exibirDestaque', "S");
		$this->db->order_by('id desc, data desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}

	function ultimas3Noticias($id)
	{
		$this->db->select("
		noticia.*,
		(SELECT count(*) FROM noticia_comentario WHERE idNoticia = id and autorizado = 'S') as comentarios
		");
		$this->db->from('noticia');
		$filtro = array('exibirPrincipal' => "S", 'id !=' => $id);
		$this->db->where($filtro);
		$this->db->order_by('id desc, data desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function noticiasRelacionadas($id)
	{
		$query = $this->db->query("
		SELECT noticia.id, noticia.titulo, noticia.data,
		(
		SELECT count(*)
		FROM noticia_tag as tag1
		INNER JOIN noticia_tag as tag2 ON tag2.idTag = tag1.idTag and tag2.idNoticia = {$id}
		WHERE tag1.idNoticia = noticia.id
		GROUP BY tag1.idNoticia
		) as tags
		
		FROM noticia
		WHERE noticia.id <> {$id}
		ORDER BY tags DESC, data DESC
		LIMIT 3
		");
		
		return $query->result_array();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select("
		noticia.*,
		(SELECT count(*) FROM noticia_comentario WHERE idNoticia = id and autorizado = 'S') as comentarios
		");
		$this->db->from('noticia');
		$this->db->order_by('id desc, data desc');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function qtd_comentarios($id)
	{
		$query = $this->db->query("
			SELECT 
				count(*) as qtd_comentarios 
			FROM 
				noticia_comentario 
			WHERE 
				idNoticia = {$id} and autorizado = 'S'");
		return $query->row_array();
	}
	
	function ver($id = 0) 
	{
		$this->db->select('n.*, f.id as idFonte,f.nomeFonte as nomeFonte,f.site as siteFonte');
		$this->db->from('noticia as n');
		$this->db->join('fonte as f', 'f.id  = n.fonte','left');
		$this->db->where("n.id", $id);
		return $this->db->get()->row_array();
	}
	
	function todas() 
	{
		$this->db->select('*');
		$this->db->from('noticia');
		return $this->db->get()->result_array();
	}
	
	function getTotal() {
		return $this->db->count_all('noticia');
	}
	
	// incrementa +1 a qtd de acesso
	function update($id)
	{
		$this->db->query("UPDATE noticia SET acesso = acesso + 1 WHERE id = {$id}");
	}
	
	function maisAcessados()
	{
		$this->db->select("
		noticia.*,
		(SELECT count(*) FROM noticia_comentario WHERE idNoticia = id and autorizado = 'S') as comentarios
		");
		$this->db->from('noticia');
		$this->db->order_by('acesso desc');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function exibirComentarios($id)
	{
		$this->db->select('*');
		$this->db->from('noticia_comentario');
		$filtro = array('autorizado' => "S", 'idNoticia' => $id);
		$this->db->where($filtro);
		$this->db->order_by('idComentario DESC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function comentarNoticia($comentar) 
	{
		$this->db->insert('noticia_comentario', $comentar);
	}
	
}
?>
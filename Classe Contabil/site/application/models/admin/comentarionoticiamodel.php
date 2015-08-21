<?php
class ComentarioNoticiaModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('noticia_comentario', array('idComentario' => $id))->row_array();
	}
	
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('noticia_comentario');
		$this->db->join('noticia', 'noticia.id  = noticia_comentario.idNoticia');
		$this->db->limit($limit, $start);
		$this->db->order_by('idComentario DESC');
		return $this->db->get();	
		
	}
	
	function opcao($id,$autorizacao)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('noticia_comentario', $autorizacao);
	}
	
	function getTotal() {
		return $this->db->count_all('noticia_comentario');
	}
	
	function deletar($id)
	{
		$this->db->delete('noticia_comentario', array('idComentario' => $id));
	}
	
	
	function update($id, $artigo)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('noticia_comentario', $artigo);
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('artigo', $exibe);
	}

}
?>
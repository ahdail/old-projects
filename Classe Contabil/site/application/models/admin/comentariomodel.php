<?php
class ComentarioModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('artigo_comentario', array('idComentario' => $id))->row_array();
	}
	
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('artigo_comentario');
		$this->db->join('artigo', 'artigo.id  = artigo_comentario.idArtigo');
		$this->db->limit($limit, $start);
		$this->db->order_by('idComentario DESC');
		return $this->db->get();	
		
	}
	
	function opcao($id,$autorizacao)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('artigo_comentario', $autorizacao);
	}
	
	function getTotal() {
		return $this->db->count_all('artigo_comentario');
	}
	
	function deletar($id)
	{
		$this->db->delete('artigo_comentario', array('idComentario' => $id));
	}
	
	
	function update($id, $artigo)
	{
		$this->db->where('idComentario', $id);
		$this->db->update('artigo_comentario', $artigo);
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('artigo', $exibe);
	}

}
?>
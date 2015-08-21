<?php
class NoticiaModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('noticia', array('id' => $id))->row_array();
	}
	
	function insert($noticia,$tags)
	{
		$this->db->insert('noticia', $noticia);
		$idNoticia = $this->db->insert_id();
		if ($tags) {
			foreach ($tags as $idTag):
				$valores = array('idNoticia' => $idNoticia,'idTag' => $idTag);
				$this->db->insert('noticia_tag', $valores);												
			endforeach;
		}
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirTitulo($id = 0)
	{
		$this->db->select('titulo');
		return $this->db->get_where('noticia', array('id' => $id))->row_array();
	}
	
	function getTotal() {
		return $this->db->count_all('noticia');
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('noticia', array('id' => $id))->row_array();
	}
	
	function deletar($id)
	{
		$this->db->delete('noticia', array('id' => $id));
	}
	
	function update($id, $noticia, $tags)
	{
		$this->db->where('idNoticia', $id);
		$this->db->delete('noticia_tag');
		
		if ($tag) {
			foreach ($tags as $idTag):
				$valores = array('idNoticia' => $id,'idTag' => $idTag);
				$this->db->insert('noticia_tag', $valores);												
			endforeach;
			
			$this->db->where('id', $id);
			$this->db->update('noticia', $noticia);
		} else {
			$this->db->where('id', $id);
			$this->db->update('noticia', $noticia);
		}
		
	}
	
	function exibirLista($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('noticia', $exibe);
	}
	
	function verificaImagem($id) {
		$this->db->select('icoDestaque');
		$this->db->where('id', $id); 
		return $this->db->get('noticia')->row_array();
	}

}
?>
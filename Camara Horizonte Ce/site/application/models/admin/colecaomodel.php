<?php
class ColecaoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('colecao', array('id' => $id))->row_array();
	}
	
	function insert($colecao)
	{
		$this->db->insert('colecao', $colecao);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('colecao');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('colecao');
	}
	
	function deletar($id)
	{
		$this->db->delete('colecao', array('id' => $id));
	}
	
	function update ($id, $colecao)
	{
		$this->db->where('id', $id);
		$this->db->update('colecao', $colecao);
	}

	function todasColecoes()
	{
		$this->db->select('id, nomecolecao');
		$this->db->from('colecao');	
		$this->db->order_by("id DESC");		
		return $this->db->get()->result_array();
	}
	
	function colecaoAtual()
	{
		$this->db->select('id, nomecolecao');
		$this->db->from('colecao');	
		$this->db->order_by("id DESC");
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
	function colecaoAtualFotos($idcolecao)
	{	
		$this->db->select('nomecolecao, colecao_foto.idColecao, colecao_foto.fotoColecao,colecao_foto.fotoColecaoThumb, colecao_foto.id, colecao_foto.descricao');
		$this->db->from('colecao');
		$this->db->join('colecao_foto', 'colecao.id = colecao_foto.idColecao');
		$this->db->where('idColecao', $idcolecao);
		$this->db->order_by("colecao_foto.id DESC");
		//$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	
	
		
	}
	
}
?>
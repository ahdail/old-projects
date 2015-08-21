<?php
class ColecaoFotoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('colecao_foto', array('id' => $id))->row_array();
	}
	
	function insert($colecaofoto)
	{
		$this->db->insert('colecao_foto', $colecaofoto);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit, $idcolecao)
	{
		$this->db->select('nomecolecao, colecao_foto.idColecao, colecao_foto.fotoColecaoThumb, colecao_foto.id');
		$this->db->from('colecao');
		$this->db->join('colecao_foto', 'colecao.id = colecao_foto.idColecao');
		$this->db->where('idColecao', $idcolecao);
		$this->db->order_by("colecao_foto.id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal($idcolecao) {
		$this->db->where('idColecao', $idcolecao);
		return $this->db->count_all_results('colecao_foto');
	}
	
	function deletar($id)
	{
		$this->db->delete('colecao_foto', array('id' => $id));
	}
	
	function update ($id, $colecaofoto)
	{
		$this->db->where('id', $id);
		$this->db->update('colecao_foto', $colecaofoto);
	}

}
?>
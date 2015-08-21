<?php
class GaleriaModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('galeria', array('id' => $id))->row_array();
	}
	
	function insert($galeria)
	{
		$this->db->insert('galeria', $galeria);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('galeria');
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('galeria');
	}
	
	function deletar($id)
	{
		$this->db->delete('galeria', array('id' => $id));
	}
	
	function update ($id, $galeria)
	{
		$this->db->where('id', $id);
		$this->db->update('galeria', $galeria);
	}

	function todasGalerias()
	{
		$this->db->select('id, nomegaleria');
		$this->db->from('galeria');		
		$this->db->order_by("id DESC");		
		return $this->db->get()->result_array();
	}
	
	
	
	
	function galeriaAtual()
	{
		$this->db->select('id, nomegaleria');
		$this->db->from('galeria');			
		$this->db->order_by("id DESC");
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
	function galeriaAtualFotos($idgaleria)
	{

		$this->db->select('nomegaleria, galeria_foto.idGaleria, galeria_foto.fotoGaleria, galeria_foto.fotoGaleriaThumb, galeria_foto.id, galeria_foto.descricao');
		$this->db->from('galeria');
		$this->db->join('galeria_foto', 'galeria.id = galeria_foto.idGaleria');
		$this->db->where('idGaleria', $idgaleria);
		$this->db->order_by("galeria_foto.id DESC");
		//$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
		
	}
	
}
?>
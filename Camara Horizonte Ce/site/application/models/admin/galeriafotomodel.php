<?php
class GaleriaFotoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('galeria_foto', array('id' => $id))->row_array();
	}
	
	function insert($galeriafoto)
	{
		$this->db->insert('galeria_foto', $galeriafoto);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit, $idgaleria)
	{
		$this->db->select('nomegaleria, galeria_foto.idGaleria, galeria_foto.fotoGaleriaThumb, galeria_foto.id');
		$this->db->from('galeria');
		$this->db->join('galeria_foto', 'galeria.id = galeria_foto.idGaleria');
		$this->db->where('idGaleria', $idgaleria);
		$this->db->order_by("galeria_foto.id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal($idgaleria) 
	{
		
		$this->db->where('idGaleria', $idgaleria);
		return $this->db->count_all_results('galeria_foto');
	}
	
	function deletar($id)
	{
		$this->db->delete('galeria_foto', array('id' => $id));
	}
	
	function update ($id, $galeriafoto)
	{
		$this->db->where('id', $id);
		$this->db->update('galeria_foto', $galeriafoto);
	}

}
?>
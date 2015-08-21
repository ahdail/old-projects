<?php
class ImprimirModel extends Model{
	
	function imprimirNoticia($id) 
	{
		return $this->db->get_where('noticia', array('id' => $id))->row_array();
	}
	
	function imprimirArtigo($id) 
	{
		return $this->db->get_where('artigo', array('id' => $id))->row_array();
	}
	
	function imprimirJuizo($id) 
	{
		return $this->db->get_where('juizo_diario', array('id' => $id))->row_array();
	}
	
	function imprimirDireito($id) 
	{
		return $this->db->get_where('direito', array('id' => $id))->row_array();
	}
	
}
?>
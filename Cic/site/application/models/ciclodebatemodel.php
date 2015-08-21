<?php
class CicloDebateModel extends Model {
	
	
	function PagPrincipal()
	{
		$this->db->select('*');
		$this->db->from('programa');
		$this->db->where('exibir', "S");
		$this->db->order_by('data desc');
		return $this->db->get()->result_array();
	}
	
	function programa($id)
	{
		$this->db->select('*');
		$this->db->from('programa');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
	
	function ler($idPrograma)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('idPrograma', $idPrograma);
		$this->db->order_by('parte ASC');
		return $this->db->get()->result_array();
	}
	
	function exibirPrograma()
	{
		$this->db->select('id,titulo');
		$this->db->from('programa');
		//$this->db->where('(SELECT count(*) FROM video WHERE video.idPrograma = programa.id) > 0', NULL, FALSE);
		$this->db->where('exibir',"S");
		$this->db->order_by('data desc');
		return $this->db->get()->result_array();
	}
	
	function exibirProgramaVideo($id)
	{
		if (!$id) {
			$this->db->select('video.parte, video.resumo, video.arquivo, programa.titulo, programa.data');
			$this->db->from('video');
			$this->db->join('programa', 'programa.id  = video.idPrograma','left');
			$this->db->where('(SELECT count(*) FROM video WHERE video.idPrograma = programa.id) > 0', NULL, FALSE);
			//$this->db->where('exibir', "S");
			$this->db->order_by('data DESC');
			$this->db->limit(2);
			return $this->db->get()->result_array();
			
		}
		if ($id) {
			$this->db->select('video.parte, video.resumo, video.arquivo, programa.titulo, programa.data');
			$this->db->from('video');
			$this->db->join('programa', 'programa.id  = video.idPrograma','left');
			$this->db->where('video.idPrograma',$id);
			$this->db->order_by('parte');
			return $this->db->get()->result_array();
		}
	}
	
	
	
}
?>
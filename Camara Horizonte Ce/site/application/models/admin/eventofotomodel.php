<?php
class EventoFotoModel extends Model {

	function detalhar($id = 0) 
	{
		return $this->db->get_where('evento_foto', array('id' => $id))->row_array();
	}
	
	function insert($eventofoto)
	{
		$this->db->insert('evento_foto', $eventofoto);
		$idquemsomos = $this->db->insert_id();
	}
	
	function exibir($start, $limit, $idevento)
	{
		$this->db->select('titulo, evento_foto.idEvento, evento_foto.fotoEventoThumb, evento_foto.id');
		$this->db->from('evento');
		$this->db->join('evento_foto', 'evento.id = evento_foto.idEvento');
		$this->db->where('idEvento', $idevento);
		$this->db->order_by("evento_foto.id DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal($idevento) {
		$this->db->where('idEvento', $idevento);
		return $this->db->count_all('evento_foto');
	}
	
	function deletar($id)
	{
		$this->db->delete('evento_foto', array('id' => $id));
	}
	
	function update ($id, $eventofoto)
	{
		$this->db->where('id', $id);
		$this->db->update('evento_foto', $eventofoto);
	}
	
	function todasFotosEvento($idevento)
	{
		return $this->db->get_where('evento_foto', array('idEvento' => $idevento))->result_array();
	}

}
?>
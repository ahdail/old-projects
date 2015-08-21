<?php
class EventosModel extends CI_Model {
	
	function detalhar($id_agenda = 0) {
		return $this->db->get_where('agenda', array('id_agenda' => $id_agenda))->row_array();
	}
	
	function insert($evento)
	{
		//print_r($agenda);
		//die();
		$this->db->insert('agenda', $evento);
	}
	
	function deletar($id)
	{
		$this->db->delete('agenda', array('id_agenda' => $id));
	}
	
	function update($id, $agenda)
	{
		$this->db->where('id_agenda', $id);
		$this->db->update('agenda', $agenda);
	}
	
	function agenda_destaque()
	{		
		$this->db->select('*');
		$this->db->from('agenda');
		$this->db->where('destaque', 'S');
		$this->db->where('id_secretaria', '0');		
		$this->db->limit(1);
		$this->db->order_by("data desc");
		return $this->db->get()->row_array();
	
	}
	
	function eventos_todos()
	{		
		$this->db->select('a.*, s.*');
		//$this->db->select('*');
		$this->db->from('agenda as a');	
		$this->db->join('secretarias as s', 'a.id_secretaria = s.id_secretaria', 'left');	
		//$this->db->where('destaque', 'N');	
		//$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function noticias_todas_site()
	{		
		$this->db->select('n.*, s.*');
		$this->db->from('noticias as n');	
		$this->db->join('secretarias as s', 'n.id_secretaria = s.id_secretaria', 'left');	
		$this->db->where('destaque !=', 'S');	
		//$this->db->where('id_secretaria !=', '0');	
		$this->db->order_by("data DESC, id_noticia ASC");
		return $this->db->get()->result_array();	
	}
	
	function noticias_gerais()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function secretarias()
	{		
		$this->db->select('*');
		$this->db->from('secretarias');		
		//$this->db->where('destaque', 'N');	
		//$this->db->order_by("data desc");
		return $this->db->get()->result_array();	
	}
	
	function noticias_todas_secretaria()
	{		
		$this->db->select('*');
		$this->db->from('noticias');		
		$this->db->order_by("id desc");
		//$this->db->where('exibir_em', $exibir_em);
		return $this->db->get()->result_array();
	
	}
	
}
?>
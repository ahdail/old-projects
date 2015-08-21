<?php
class BoletimModel extends Model {
		
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('boletim_aux');
		$this->db->limit($limit, $start);
		$this->db->where("enviada =", "S");
		$this->db->order_by('id desc');
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('boletim_aux');
	}
	
	function verNoticiaBoletim($id)
	{
		
		$this->db->select('n.id,n.titulo,n.resumo,n.data');
		$this->db->from('noticia as n');
		$this->db->join('boletim as b', 'n.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"N");
		return $this->db->get()->result_array(); 
	}
	
	function verJuizoBoletim($id)
	{
		
		$this->db->select('j.id,j.pergunta');
		$this->db->from('juizo_diario as j');
		$this->db->join('boletim as b', 'j.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"J");
		return $this->db->get()->result_array(); 
	}
	
	function verArtigoBoletim($id)
	{
		
		$this->db->select('a.id,a.titulo,a.resumo,a.data');
		$this->db->from('artigo as a');
		$this->db->join('boletim as b', 'a.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"A");
		return $this->db->get()->result_array(); 
	}
	
	
}
?>
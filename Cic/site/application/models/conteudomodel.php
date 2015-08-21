<?php
class ConteudoModel extends Model {
	
	function PagInicial()
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('exibir ', "EP");
		$this->db->where('exibir !=', "CE");
		$this->db->where('exibir !=', "OP");
		$this->db->order_by('data desc, id desc');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	
	function Ultimas5($id)
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$filtro = array('exibir' => "EP", 'id !=' => $id);
		$this->db->where($filtro);
		$this->db->order_by('id desc, data desc');
		$this->db->limit(5);
		return $this->db->get()->result_array();
		
	}
	
	function PagPrincipal($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('exibir ', "EP");
		$this->db->where('exibir !=', "CE");
		$this->db->where('exibir !=', "OP");
		$this->db->order_by('data desc, id desc');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		$this->db->where('exibir ', "EP");
		$this->db->where('exibir !=', "CE");
		$this->db->where('exibir !=', "OP");
		return $this->db->count_all('conteudo');
	}
	/*
	function PagPrincipal()
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('exibir ', "EP");
		$this->db->where('exibir !=', "CE");
		$this->db->where('exibir !=', "OP");
		$this->db->order_by('data desc, id desc');
		//$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	*/
	function PalavraPresidente()
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('exibir', "OP");
		$this->db->where('exibir !=', "CE");
		$this->db->where('exibir !=', "EP");
		$this->db->order_by('id desc, data desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function CicEmprensa()
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('exibir', "CE");
		$this->db->where('exibir !=', "OP");
		$this->db->where('exibir !=', "EP");
		$this->db->order_by('id desc, data desc');
		return $this->db->get()->result_array();
	}
	
	function ler($id)
	{
		$this->db->select('*');
		$this->db->from('conteudo');
		$this->db->where('id', $id);
		return $this->db->get()->result_array();
	}
	
}
?>
<?php
class CaixaModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('caixa', array('id' => $id))->row_array();
	}
	
	function insert($caixa)
	{
		$this->db->insert('caixa', $usuariocategoria);
	}
	//verifica se o existe caixa aberto
	function verificaCaixa($idUsuario)
	{
		return $this->db->get_where('caixa', array('idUsuario' => $idUsuario, 'fechado' => "N"))->row_array();
	}
	
	// verifica qual foi o ultimo caixa fechado
	function verificaUltimoCaixa($idUsuario)
	{
		$this->db->select('*');
		$this->db->from('caixa');
		$this->db->where('idUsuario', $idUsuario);
		$this->db->order_by("id DESC");	
		$this->db->limit(1);
		return $this->db->get()->row_array();		
	}
	// Abri um novo caixa
	function abrirCaixa($caixa)
	{		
			$this->db->insert('caixa', $caixa);
	}
	// Fecha o caixa
	function fecharCaixa($numCaixa, $idUsuario, $caixa)
	{		
		$this->db->where(array('idUsuario' => $idUsuario, 'numCaixa' => $numCaixa));
		$this->db->update('caixa', $caixa);
		
		//$this->db->delete('caixa', array('idUsuario' => $idUsuario, 'numCaixa' => $caixa));		
	}
		
	function update($id,$caixa)
	{
		$this->db->where('id', $id);
		$this->db->update('caixa', $caixa);
	}
	
	function getTotal() {
		return $this->db->count_all('caixa');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('c.*, usuario.nome as nomeUsuario, usuario.id as idUsuario');
		$this->db->from('caixa as c');
		$this->db->join('usuario', 'c.idUsuario  = usuario.id','inner');
		$this->db->order_by("id ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function listarCategoriasUsuario()
	{
		$this->db->select('*');
		$this->db->from('usuariocategoria');
		$this->db->order_by("nomecategoria ASC");		
		return $this->db->get()->result_array();
	}
	
}
?>
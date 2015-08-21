<?php
class VendaModel extends Model {
	
	function concluiVenda($venda, $indiceQtdCategoria, $indiceValorSubTotalCategoria )
	{
		$this->db->insert('venda', $venda);		
		$idVenda = $this->db->insert_id();
		
		$i = 0;
		foreach ($indiceQtdCategoria as $idCategoria):		
			$valores = array('idCategoria' => $idCategoria,'idVenda' => $idVenda, 'subTotalCategoria' =>$indiceValorSubTotalCategoria[$i]);
			$this->db->insert('vendacategoria', $valores);
			$i++;
		endforeach;		
	}
		
	// verifica qual foi o ultimo caixa fechado
	function ultimasVendas($idUsuario)
	{
		$this->db->select('*');
		$this->db->from('venda');
		$this->db->where('idUsuario', $idUsuario);
		$this->db->order_by("id DESC");	
		//$this->db->limit(1);
		return $this->db->get()->result_array();		
	}

	
	function getTotal() {
		return $this->db->count_all('venda');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('venda');
		$this->db->order_by("id ASC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function somatorio($idUsuario, $numCaixa)
	{
		$this->db->select_sum('valorTotal');
		$this->db->where('idCaixa', $numCaixa);
		$this->db->where('idUsuario', $idUsuario);
		return $this->db->get('venda')->row_array();
	}
	
	function somatorioGeral()
	{
		$this->db->select_sum('valorTotal');
		//$this->db->where('idCaixa', $numCaixa);
		//$this->db->where('idUsuario', $idUsuario);
		return $this->db->get('venda')->row_array();
	}
	function caixasTotal() {
		return $this->db->count_all('caixa');
	}
	
}
?>
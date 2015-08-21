<?php
class BannerModel extends Model {
	
	
	
	function exibirBannerLateral($ordem)
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where(array('exibir'=>"S", 'posicao'=>1, 'ordem'=>$ordem));
		$this->db->limit(1);
		$this->db->order_by('rand()');
		return $this->db->get()->row_array();
	}
	
	function exibirBannerRodape()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where(array('exibir'=>"S", 'posicao'=>2));
		$this->db->limit(6);
		$this->db->order_by('rand()');
		return $this->db->get()->result_array();
	}
	
	function exibirBannerExclusivo()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where(array('exibir'=>"S", 'posicao'=>3));
		$this->db->limit(1);
		$this->db->order_by('rand()');
		return $this->db->get()->row_array();
	}
	
	
}
?>
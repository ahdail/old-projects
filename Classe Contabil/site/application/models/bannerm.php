<?php
class BannerM extends Model {
	
	function exibirBannerSitePosicao1()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('posicao', 1); 
		$this->db->limit(1);
		$this->db->order_by('id desc');
		return $this->db->get()->result_array();
	}
	
	function exibirBannerSitePosicao2()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('posicao', 2); 
		$this->db->limit(1);
		$this->db->orderby('id','desc');
		return $this->db->get()->result_array();
	}
	
	function exibirBannerSitePosicao3()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('posicao', 3);
		$this->db->orderby('id','desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	
	function exibirBannerSitePosicao4()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('posicao', 4);
		$this->db->limit(1);
		$this->db->order_by('id desc');
		return $this->db->get()->result_array();
	}
	
	function exibirBannerSitePosicao5()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('posicao', 5);
		$this->db->limit(1);
		$this->db->order_by('id desc');
		return $this->db->get()->result_array();
	}
	
	
	function soEndereco($id)
	{
		$this->db->select('url');
		$this->db->from('banner');
		$this->db->where('exibir', "S");
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
}
?>
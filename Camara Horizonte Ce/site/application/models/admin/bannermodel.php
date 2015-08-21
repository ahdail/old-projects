<?php
class BannerModel extends Model {
	
	function detalhar($id = 0) {
		return $this->db->get_where('banner', array('id' => $id))->row_array();
	}
	
	function insert($banner)
	{
		$this->db->insert('banner', $banner);
		$idBanner = $this->db->insert_id();
		return $idBanner;
	}
	
	function deletar($id)
	{
		$this->db->delete('banner', array('id' => $id));
	}
	
	function update($id,$banner)
	{
		$this->db->where('id', $id);
		$this->db->update('banner', $banner);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->order_by("id desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('banner');
	}
	
	function opcao($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('banner', $exibe);
	}
	
	function exibirBanner($idBanner)
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('id', $idBanner);
		return $this->db->get()->result_array();
	}
	
	function exibirBannerSite()
	{
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('mostrar', "S");
		return $this->db->get()->result_array();
	}
	
	
}
?>
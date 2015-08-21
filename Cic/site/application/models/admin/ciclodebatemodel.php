<?php
class CicloDebateModel extends Model {

	function programaDetalhar($id = 0) 
	{
		return $this->db->get_where('programa', array('id' => $id))->row_array();
	}
	
	function programaInsert($programa)
	{
		$this->db->insert('programa', $programa);
	}
	
	function programaExibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('programa');
		$this->db->order_by("data DESC");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function opcao($id, $exibir)
	{
		
		$this->db->where('id', $id);
		$this->db->update('programa', $exibir);
	}
	
	
	function programaGetTotal() {
		return $this->db->count_all('programa');
	}
	
	
	function programaExibirData()
	{
		$this->db->select('data');
		return $this->db->get_where('programa', array('id' => $id))->row_array();
	}
	
	function programaDeletar($id)
	{
		$this->db->delete('programa', array('id' => $id));
	}
	
	function programaUpdate($id, $programa)
	{
		
		$this->db->where('id', $id);
		$this->db->update('programa', $programa);
	}
	
	function programaExibirVideo($idPrograma) {
		$this->db->select('arquivo, resumo, parte, id');
		$this->db->from('video');
		$this->db->where('idPrograma', $idPrograma);
		return $this->db->get()->result_array();
	}
	
	
	/**   Tudo sobre v�deo   */
	
	function programaDetalharVideo($id = 0) 
	{
		return $this->db->get_where('video', array('id' => $id))->row_array();
	}
	
	function videoInsert($video)
	{
		$this->db->insert('video', $video);
	}
	
	function videoExibir($start, $limit)
	{
		$this->db->select('video.arquivo,video.resumo,video.parte,programa.titulo,video.id');
		$this->db->from('video');
		$this->db->join('programa','programa.id = video.idPrograma','left' );
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	
	function videoGetTotal() {
		return $this->db->count_all('video');
	}
	
	function videoDeletar($id)
	{
		$this->db->delete('video', array('id' => $id));
	}
	
	function videoUpdate($id, $video)
	{
		
		$this->db->where('id', $id);
		$this->db->update('video', $video);
	}
	
	// Verifica se j� existe um v�deo gravado nessa parte para este programa
	function verficaVideoParteUnica($parte, $idPrograma) {
		$this->db->select('parte');
		$this->db->from('video');
		$this->db->where(array('idPrograma'=>$idPrograma, 'parte'=>$parte));
		return ($this->db->get()->num_rows() > 0);
	}
	
	function exibirVideo($idVideo)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('id', $idVideo);
		return $this->db->get()->result_array();
	}
	
	function todosProgramas()
	{
		$this->db->select('id, titulo');
		$this->db->from('programa');
		return $this->db->get()->result_array();
	}
	
	
	
}
?>
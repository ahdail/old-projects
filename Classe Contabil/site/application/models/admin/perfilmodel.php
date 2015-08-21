<?php
class PerfilModel extends Model {
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('perfil', array('id' => $id))->row_array();
	}
	
	function insert($perfil,$indice)
	{
		$this->db->insert('perfil', $perfil);
		$idPerfil = $this->db->insert_id();
		
		foreach ($indice as $idSecao):
			$valores = array('idSecao' => $idSecao,'idPerfil' => $idPerfil);
			$this->db->insert('secao_perfil', $valores);												
		endforeach;
	}
	
	function insertEdicao($perfil,$indice,$id)
	{
		$this->db->where('idPerfil', $id);
		$this->db->delete('secao_perfil');
		 
		$this->db->where('id', $id);
		$this->db->update('perfil', $perfil);
		
		foreach ($indice as $idSecao):
			$valores = array('idSecao' => $idSecao,'idPerfil' => $id);
			$this->db->insert('secao_perfil', $valores);												
		endforeach;
	}
	
	function deletar($id)
	{
		$this->db->delete('perfil', array('id' => $id));
	}
	
	function update($id,$perfil)
	{
		$this->db->where('id', $id);
		$this->db->update('perfil', $perfil);
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('perfil');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		return $this->db->count_all('perfil');
	}
	
	function exibirSecao()
	{
		return $this->db->get('secao')->result_array();
	}
	
	function exibirPerfil($idPerfil)
	{
		$this->db->select('secao.nome,secao.id');
		$this->db->from('secao');
		$this->db->join('secao_perfil', 'secao.id  = secao_perfil.idSecao','left');
		$this->db->where('idPerfil', $idPerfil);
		return $this->db->get()->result_array();
	}
	
	function exibirPerfilNotIn($idPerfil)
	{
		$this->db->select('secao.nome,secao.id');
		$this->db->from('secao');
		$where = "id NOT IN (SELECT idSecao from secao_perfil WHERE idPerfil = {$idPerfil})";
		$this->db->where($where);
		return $this->db->get()->result_array();
	}
	
}
?>
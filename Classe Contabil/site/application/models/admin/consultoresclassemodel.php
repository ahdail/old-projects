<?php
class ConsultoresClasseModel extends Model {

	function detalhar($id) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->row_array();
	}
	
	function insert($consultoresClasse)
	{
		$this->db->insert('usuarios_classe', $consultoresClasse);
	}
	
	function deletar($id)
	{
		$this->db->delete('usuarios_classe', array('id' => $id));
	}
	
	function update($id, $consultoresClasse)
	{
		$this->db->where('id', $id);
		$this->db->update('usuarios_classe', $consultoresClasse);
	}
	
	function buscarConsultor($search) 
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where("consultor", 2);
		$this->db->like('nome', $search, 'match'); 
		return $this->db->get()->result_array();
	}
	
	function exibirTodos($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where('consultor =', 2);
		$this->db->or_where('consultor =', 1);
		$this->db->order_by('nome');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
		/*$query = $this->db->query("	
			SELECT estado.sigla as estado, estado.NOME,	count(*) as total
			FROM usuarios_classe
			
			INNER JOIN mun ON usuarios_classe.cidade = mun.codigo
			INNER JOIN estado ON estado.sigla = mun.ufd_sigla
			
			WHERE consultor = 2
			GROUP BY estado.sigla, estado.nome
			ORDER BY estado.sigla
			LIMIT {$limit}, {$start}
		");
		
		return $this->db->get();*/
	}
	
	function exibirAutorizado($filtro, $start, $limit)
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where('consultor =', $filtro);
		$this->db->order_by('nome');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}
	
	function exibirAguardando($filtro, $start, $limit)
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where('consultor =', $filtro);
		$this->db->order_by('nome');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}
	
	function getTotal($filtro=false, $tipo=false) {
		switch ($tipo) {
			case 1: // Aguardando Autorização
				$this->db->where("consultor", $filtro);
				break;
				
			case 2: // Autorizado
				$this->db->where("consultor", $filtro);
				break;
		}

		$this->db->from('usuarios_classe');
		return $this->db->count_all_results();
		
	}
	
	function temas() 
	{
		$this->db->select('*');
		$this->db->from('consultoria_temas');
		$this->db->order_by('tema');
		return $this->db->get()->result_array();
	}
	
	
	
}
?>
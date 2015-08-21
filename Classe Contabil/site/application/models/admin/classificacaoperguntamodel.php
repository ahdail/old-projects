<?php 
class Classificacaoperguntamodel extends Model
{
	// Retorna a data do último evento
	function getUltimaPergunta()
	{
		$this->db->select('YEAR(data) as ano, MONTH(data) as mes', false);
		$this->db->from('consultoria_perguntas');
		$this->db->order_by('data DESC');
		$this->db->where('importado = 1');
		$this->db->limit(1);
		
		return $this->db->get()->row_array();
	}
	
	function getTemas()
	{
		$this->db->select('*');
		$this->db->from('consultoria_temas');
		$this->db->order_by('tema ASC');
		return $this->db->get()->result_array();	
	}
	
	// Retorna as próximas 20 perguntas em uma data 
	function getPerguntas($data)
	{
		$this->db->select('*');
		$this->db->from('consultoria_perguntas');
		$this->db->where("DATE_FORMAT(data, '%Y-%m-%d') = '{$data}'");
		$this->db->where('importado = 1');
		$this->db->limit(21);
		$this->db->order_by('data');
		
		return $this->db->get()->result_array();
	}
	
	function getPerguntasTotal($data)
	{
		$this->db->from('consultoria_perguntas');
		$this->db->where("DATE_FORMAT(data, '%Y-%m-%d') = '{$data}'");
		$this->db->where('importado = 1');
		return $this->db->count_all_results();
	}
	
	// Retorna a proxima pergunta da listagem
	function getProximaPergunta($data)
	{
		$this->db->select('*');
		$this->db->from('consultoria_perguntas');
		$this->db->where("DATE_FORMAT(data, '%Y-%m-%d') = '{$data}'");
		$this->db->where('importado = 1');
		$this->db->limit(1, 20);
		$this->db->order_by('data');
		
		return $this->db->get()->row_array();
	}
	
	// Retorna a lista de perguntas nao classificadas em um dado periodo
	function listarPerguntas($mes, $ano)
	{
		$this->db->select('*');
		$this->db->from('consultoria_perguntas');
		$this->db->where("MONTH(data) = {$mes} and YEAR(data) = {$ano}", NULL, FALSE);
		$this->db->where('importado = 1');
		$this->db->order_by('data');
		return $this->db->get()->result_array();
	}
	
	// Modifica o tema de uma pergunta
	function setTema($idPergunta, $idTema) 
	{
		$array = array(
			'idTema' => $idTema,
			'importado' => 2
		);
		
		$this->db->where('id', $idPergunta);
		$this->db->update('consultoria_perguntas', $array);
	}
}
?>
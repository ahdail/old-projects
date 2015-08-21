<?php
class EnqueteModel extends Model {
	
	
	/**       TUDO SOBRE PERGUNTA  */

	function perguntaDetalhar($id = 0) 
	{
		return $this->db->get_where('enquete_pergunta', array('id' => $id))->row_array();
	}
	
	function perguntaInsert($enquetePergunta)
	{
		$this->db->insert('enquete_pergunta', $enquetePergunta);
	}
	
	function perguntaExibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function perguntaGetTotal() {
		return $this->db->count_all('enquete_pergunta');
	}
	
	function perguntaDeletar($id)
	{
		$this->db->delete('enquete_pergunta', array('id' => $id));
	}
	
	
	function perguntaUpdate($id, $enquetePergunta)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete_pergunta', $enquetePergunta);
	}
	
	function perguntaExibe($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete_pergunta', $exibe);
	}
	
	/**       FIM SOBRE PERGUNTA  */
	
	/**       TUDO SOBRE RESPOSTA  */
	
	function respostaDetalhar($id = 0) 
	{
		return $this->db->get_where('enquete_resposta', array('id' => $id))->row_array();
	}
	
	function respostaInsert($enqueteResposta)
	{
		$this->db->insert('enquete_resposta', $enqueteResposta);
	}
	
	function respostaExibir($idPergunta)
	{
		$this->db->select('*');
		$this->db->from('enquete_resposta');
		$this->db->where('idPergunta', $idPergunta);
		return $this->db->get()->result_array();
	}
	
	function todasPerguntas()
	{
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		return $this->db->get()->result_array();
	}
	
	function respostaGetTotal() {
		return $this->db->count_all('enquete_resposta');
	}
	
	function respostaDeletar($id)
	{
		$this->db->delete('enquete_resposta', array('id' => $id));
	}
	
	
	function respostaUpdate($id, $enqueteResposta)
	{
		$this->db->where('id', $id);
		$this->db->update('enquete_resposta', $enqueteResposta);
	}
	
	function enquetePerguntaDisponivel()
	{
		/*
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		return $this->db->get()->result_array;
		*/
		return $this->db->get_where('enquete_pergunta', array('exibir' => 'S'))->row_array();
	}

	
	function enqueteRespostas()
	{
		$this->db->select('er.idPergunta as idPergunta,er.resposta as resposta,er.id as idResposta');
		$this->db->from('enquete_pergunta as ep');
		$this->db->join('enquete_resposta as er', 'ep.id = er.idPergunta ', 'left');
		$this->db->where('ep.exibir','S');
		return $this->db->get()->result_array(); 
	}
	
	function totalPergunta($idPergunta)
    {
    	$this->db->select('count(idPergunta) as total,enquete_pergunta.pergunta');
		$this->db->from('enquete_votacao');
		$this->db->join('enquete_pergunta', 'enquete_pergunta.id  = enquete_votacao.idPergunta','left');
		$this->db->where('idPergunta', $idPergunta);
		$this->db->group_by('enquete_votacao.idPergunta');
		return $this->db->get()->row_array();
    }
    
	function totalResposta($idPergunta)
    {
    	$this->db->select('enquete_votacao.idResposta, count(idResposta) AS total,enquete_resposta.resposta');
		$this->db->from('enquete_votacao');
		$this->db->join('enquete_resposta', 'enquete_resposta.id  = enquete_votacao.idResposta','left');
		$this->db->where('enquete_votacao.idPergunta', $idPergunta);
		$this->db->group_by('enquete_votacao.idResposta');
		return $this->db->get()->result_array();
    }
}
?>
<?php
class ResultadoModel extends Model{
	
    
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
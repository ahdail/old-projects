<?php
class PesquisaModel extends Model {
		
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('pesquisa');
		$this->db->limit($limit, $start);
		$this->db->order_by('id desc');
		$this->db->where("exibir" , "S");
		return $this->db->get();
	}
	
	function exibirPergunta($idPesquisa,$qtdPerguntas)
	{
		$idUsuario = $this->session->userdata('idUsuario');
		
		$this->db->select('pesquisa_pergunta.*', FALSE);
		$this->db->from('pesquisa_pergunta');
		$this->db->join('pesquisa_pergunta_resposta', 'pesquisa_pergunta.id  = pesquisa_pergunta_resposta.idPergunta and pesquisa_pergunta_resposta.idUsuario ='.$idUsuario ,'left');
		$this->db->limit($qtdPerguntas);
		$this->db->where("idPesquisa = {$idPesquisa} AND pesquisa_pergunta_resposta.id IS NULL");
		return $this->db->get()->result_array();
	}
	
	function getTotal()
	{
		return $this->db->count_all('pesquisa');
	}
	
	function inserirResposta($dados) 
	{
		$this->db->insert('pesquisa_pergunta_resposta', $dados);
	}
	
}
?>
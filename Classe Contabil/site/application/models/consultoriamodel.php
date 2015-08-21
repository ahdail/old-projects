<?php
class ConsultoriaModel extends Model {

	function perguntar ($pergunta){
		$this->db->insert('consultoria_perguntas', $pergunta);
		$idPergunta = $this->db->insert_id();
		return $idPergunta;
	}

	function ultimasPerguntas($start, $limit)
	{
		$this->db->select('
		consultoria_perguntas.*,
		consultoria_temas.tema,
		usuarios_classe.nome as nomeUsuario,
		usuarios_classe.email as emailUsuario,
		usuarios_classe.estado,
		mun.NOME as cidade,
		(SELECT count(*) from consultoria_respostas WHERE idPergunta = consultoria_perguntas.id) as totalRespostas
		', false);
		$this->db->from('consultoria_perguntas');
		$this->db->join('consultoria_temas', 'consultoria_perguntas.idTema = consultoria_temas.id', 'inner');
		$this->db->join('usuarios_classe', 'usuarios_classe.id = consultoria_perguntas.idUsuario', 'inner');
		$this->db->join('mun', 'usuarios_classe.cidade = mun.CODIGO and usuarios_classe.estado = mun.UFD_SIGLA', 'left');
		$this->db->order_by('consultoria_perguntas.data DESC');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}
	// Busca no Banco uma palavra especнfica
	function buscarChave($chave, $start, $limit)
	{
		$this->db->select('
		consultoria_perguntas.*,
		consultoria_temas.tema,
		usuarios_classe.nome as nomeUsuario,
		usuarios_classe.email as emailUsuario,
		usuarios_classe.estado,
		mun.NOME as cidade,
		(SELECT count(*) from consultoria_respostas WHERE idPergunta = consultoria_perguntas.id) as totalRespostas
		', false);
		$this->db->from('consultoria_perguntas');
		$this->db->join('consultoria_temas', 'consultoria_perguntas.idTema = consultoria_temas.id', 'inner');
		$this->db->join('usuarios_classe', 'usuarios_classe.id = consultoria_perguntas.idUsuario', 'inner');
		$this->db->join('mun', 'usuarios_classe.cidade = mun.CODIGO and usuarios_classe.estado = mun.UFD_SIGLA', 'left');
		// Monta o like
		$chaveArray = explode(' ', $chave);

		foreach ($chaveArray as $chave => $valorChave) {
			$this->db->like('pergunta', $valorChave);
		}
		$this->db->order_by('consultoria_perguntas.id ASC');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}
	// Busca pelo numero da pergunta
	function buscarNum($num)
	{
		$this->db->select('
		consultoria_perguntas.*,
		consultoria_temas.tema,
		usuarios_classe.nome as nomeUsuario,
		usuarios_classe.email as emailUsuario,
		usuarios_classe.estado,
		mun.NOME as cidade,
		(SELECT count(*) from consultoria_respostas WHERE idPergunta = consultoria_perguntas.id) as totalRespostas
		', false);
		$this->db->from('consultoria_perguntas');
		$this->db->join('consultoria_temas', 'consultoria_perguntas.idTema = consultoria_temas.id', 'inner');
		$this->db->join('usuarios_classe', 'usuarios_classe.id = consultoria_perguntas.idUsuario', 'inner');
		$this->db->join('mun', 'usuarios_classe.cidade = mun.CODIGO and usuarios_classe.estado = mun.UFD_SIGLA', 'left');
		$this->db->where("consultoria_perguntas.id", $num);
		$this->db->order_by('consultoria_perguntas.id ASC');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function temas()
	{
		$this->db->select('*');
		$this->db->from('consultoria_temas');
		$this->db->order_by('tema');
		return $this->db->get()->result_array();
	}

	function filtrarTema($id, $start, $limit)
	{
		$this->db->select('
		consultoria_perguntas.*,
		consultoria_temas.tema,
		usuarios_classe.nome as nomeUsuario,
		usuarios_classe.email as emailUsuario,
		usuarios_classe.estado,
		mun.NOME as cidade,
		(SELECT count(*) from consultoria_respostas WHERE idPergunta = consultoria_perguntas.id) as totalRespostas
		', false);
		$this->db->from('consultoria_perguntas');
		$this->db->join('consultoria_temas', 'consultoria_perguntas.idTema = consultoria_temas.id', 'inner');
		$this->db->join('usuarios_classe', 'usuarios_classe.id = consultoria_perguntas.idUsuario', 'inner');
		$this->db->join('mun', 'usuarios_classe.cidade = mun.CODIGO and usuarios_classe.estado = mun.UFD_SIGLA', 'left');
		$this->db->where("consultoria_perguntas.idTema", $id);
		$this->db->limit($limit, $start);

		return $this->db->get()->result_array();

	}


	function getTotal($filtro=false, $tipo=false) {
		switch ($tipo) {
			case 1: // Por tema
				$this->db->where("consultoria_perguntas.idTema", $filtro);
				break;

			case 2: // Por chave
				$chaveArray = explode(' ', $filtro);
				foreach ($chaveArray as $chave => $valorChave) {
					$this->db->like('pergunta', $valorChave);
				}
				break;
		}

		$this->db->from('consultoria_perguntas');
		return $this->db->count_all_results();
	}

	function ver($id = 0)
	{
		$this->db->select('
		consultoria_perguntas.*,
		usuarios_classe.nome as nomeUsuario,
		usuarios_classe.email as emailUsuario,
		usuarios_classe.estado,
		mun.NOME as cidade,
		');
		$this->db->from('consultoria_perguntas');
		$this->db->join('usuarios_classe', 'usuarios_classe.id = consultoria_perguntas.idUsuario', 'inner');
		$this->db->join('mun', 'usuarios_classe.cidade = mun.CODIGO and usuarios_classe.estado = mun.UFD_SIGLA', 'left');
		$this->db->where("consultoria_perguntas.id", $id);
		
		return $this->db->get()->result_array();
	}

	function mandarEmail($id)
	{
		$query = $this->db->query("
			SELECT p. * , u.nome, u.email
			FROM `consultoria_perguntas` AS p
			INNER JOIN usuarios_classe u ON u.id = p.idUsuario
			WHERE p.id ={$id}
		");
		return $query->result_array();
	}

	function responder ($resposta){
		$this->db->insert('consultoria_respostas', $resposta);
	}

	function verRespostas($id = 0)
	{
		$query = $this->db->query("
			SELECT
			r.id,
			r.idPergunta,
			r.data AS dataResposta,
			r.resposta,

			p.data AS dataPergunta,
			p.pergunta,
			p.idUsuario,
			p.nome AS nomeUsuario,

			e.nome as estado,

			u.email as email,
			u.id AS idConsultor,
			u.nome as nomeConsultor,
			u.consultor

			FROM
				consultoria_respostas AS r
			INNER JOIN
				consultoria_perguntas AS p ON r.idPergunta = p.id
			INNER JOIN
				usuarios_classe AS u ON r.idUsuario = u.id
			INNER JOIN
				estado as e ON e.sigla = u.estado
			WHERE
				r.idPergunta = $id
			ORDER BY
				r.data ASC
		");
		return $query->result_array();
	}

	function verificaUsuario($idUsuario)
	{
		$this->db->select("*");
		$this->db->from("consultoria_perguntas");
		$this->db->where("idUsuario", $idUsuario);
		return $this->db->get()->row_array();
	}

	function verificaAvatar($idPergunta)
	{
		$this->db->select("uc.avatar as avatar");
		$this->db->from("usuarios_classe as uc");
		$this->db->join('consultoria_perguntas as cp', 'cp.IdUsuario = uc.id', 'left');
		$this->db->where("cp.id" , $idPergunta);
		return $this->db->get()->row_array();
	}


	/* Usado na Administraзгo
	*/
	/*
	function exibir($start, $limit)
	{
		//$this->db->select('*');
		//$this->db->from('consultoria_perguntas');
		//$this->db->limit($limit, $start);
		//return $this->db->get();

		$this->db->select('p.*, t.tema');
		$this->db->from('consultoria_perguntas as p');
		$this->db->join('consultoria_temas as t', 'p.idTema=t.id', 'inner');
		$this->db->limit($limit, $start);
		$this->db->order_by('id DESC');
		return $this->db->get();

	}*/

	/*
	function getTotal() {
		return $this->db->count_all('consultoria_perguntas');
	}
	*/
}
?>
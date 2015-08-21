<?php
class PesquisaModel extends Model {
	
	
	/**       TUDO SOBRE PERGUNTA  */

	function pesquisaDetalhar($id = 0) 
	{
		return $this->db->get_where('pesquisa', array('id' => $id))->row_array();
	}
	
	function pesquisaInsert($pesquisa)
	{
		$this->db->insert('pesquisa', $pesquisa);
	}
	
	function pesquisaExibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('pesquisa');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function pesquisaGetTotal() 
	{
		return $this->db->count_all('pesquisa');
	}
	
	function pesquisaDeletar($id)
	{
		$this->db->delete('pesquisa', array('id' => $id));
	}
	
	
	function pesquisaUpdate($id, $pesquisa)
	{
		$this->db->where('id', $id);
		$this->db->update('pesquisa', $pesquisa);
	}
	
	function pesquisaExibe($id,$exibe)
	{
		$this->db->where('id', $id);
		$this->db->update('pesquisa', $exibe);
	}
	
	/**       FIM SOBRE PERGUNTA  */
	
	/**       TUDO SOBRE RESPOSTA  */
	
	function pesquisaperguntaDetalhar($id = 0) 
	{
		return $this->db->get_where('pesquisa_pergunta', array('id' => $id))->row_array();
	}
	
	function pesquisaPerguntaInsert($pesquisaPergunta)
	{
		$this->db->insert('pesquisa_pergunta', $pesquisaPergunta);
	}
	
	function pesquisaPerguntaExibir($idPesquisa)
	{
		$this->db->select('*');
		$this->db->from('pesquisa_pergunta');
		$this->db->where('idPesquisa', $idPesquisa);
		return $this->db->get()->result_array();
	}
	
	function todasPesquisas()
	{
		$this->db->select('*');
		$this->db->from('pesquisa');
		return $this->db->get()->result_array();
	}
	
	function pesquisaPerguntaGetTotal() {
		return $this->db->count_all('pesquisa_pesquisa');
	}
	
	function pesquisaPerguntaDeletar($id)
	{
		$this->db->delete('pesquisa_pergunta', array('id' => $id));
	}
	
	
	function pesquisaPerguntaUpdate($id, $pesquisaPergunta)
	{
		$this->db->where('id', $id);
		$this->db->update('pesquisa_pergunta', $pesquisaPergunta);
	}
	
	function pesquisaDisponivel()
	{
		/*
		$this->db->select('*');
		$this->db->from('enquete_pergunta');
		return $this->db->get()->result_array;
		*/
		return $this->db->get_where('pesquisa', array('exibir' => 'S'))->row_array();
	}

	
	function PesquisasPerguntas()
	{
		$this->db->select('pp.idPesquisa as idPesquisa,pp.resposta as pergunta,pp.id as idPergunta');
		$this->db->from('pesquisa_pergunta as pp');
		$this->db->join('pesquisa as p', 'p.id = pp.idPesquisa ', 'left');
		$this->db->where('p.exibir','S');
		return $this->db->get()->result_array(); 
	}
	
function getPerguntas($idPesquisa)
	{
		$this->db->select('*');
		$this->db->from('pesquisa_pergunta');
		$this->db->where("idPesquisa", $idPesquisa);
		return $this->db->get()->result_array();
	}
	
	function getRelatorio($dados)
	{
		// Pega as perguntas e percorre
		$perguntas = $this->getPerguntas($dados['idPesquisa']);
		foreach($perguntas as $rowPergunta) {
			$retorno[] = $this->getVotos($rowPergunta, $dados['idCargos'], $dados['idEstado']);
		}
		
		return $retorno;
	}
	
	function getVotos($pergunta, $idCargos, $idEstado) {
		// Percorre os cargos e cria o where
		if ($idCargos) {
			foreach ($idCargos as $cargo) {
				$cargos .= $cargo.",";
			}
			
			$cargos = substr($cargos, 0, -1);
			
			$whereCargos = " and idOcupacao IN ({$cargos})";
		}
		
		if ($idEstado) {
			$whereEstado = " and estado = '{$idEstado}'";
		}
		
		
		// Inicia o array de retorno
		$rowTotal = $this->db->query("
		SELECT count(*) as total
		FROM pesquisa_pergunta_resposta
		LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
		WHERE idPergunta = {$pergunta['id']} $whereCargos $whereEstado
		")->row_array();
		
		$retorno['Pergunta'] = $pergunta['pergunta'];
		$retorno['TotalVotos'] = $rowTotal['total'];
		$retorno['Tipo'] = $pergunta['tipo'];
		
		switch ($pergunta['tipo']) { // Tipo da pergunta
			case 1: // Aberta
				$resultado = $this->db->query("
				SELECT texto
				FROM pesquisa_pergunta_resposta
				LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
				WHERE idPergunta = {$pergunta['id']} $whereCargos $whereEstado
				")->result_array();
				
				// Respostas
				foreach($resultado as $row) {
					$retorno["Respostas"][$row['texto']] = null;
				}
				
				break;
			
			case 2: // Sim/Não
				$row = $this->db->query("
				SELECT
				(
					SELECT COUNT(*)
					FROM pesquisa_pergunta_resposta
					LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
					WHERE idPergunta = {$pergunta['id']} and op1 = 1 $whereCargos $whereEstado
				) as sim,
				(
					SELECT COUNT(*)
					FROM pesquisa_pergunta_resposta
					LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
					WHERE idPergunta = {$pergunta['id']} and op1 = 2 $whereCargos $whereEstado
				) as nao 
				")->row_array();
				
				// Respostas
				$retorno["Respostas"] = array(
					"Sim" => array ("Valor" => $row['sim'], "Porcentagem" => ($row['sim']) ? ($row['sim']/$retorno["TotalVotos"])*100 : 0),
					"Não" => array ("Valor" => $row['nao'], "Porcentagem" => ($row['nao']) ? ($row['nao']/$retorno["TotalVotos"])*100 : 0)
				);

				break;

			case 3: // Múltipla escolha
				$row = $this->db->query("
				SELECT
				SUM(op1) as op1,
				SUM(op2) as op2,
				SUM(op3) as op3,
				SUM(op4) as op4
				
				FROM pesquisa_pergunta_resposta
				LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
				WHERE idPergunta = {$pergunta['id']} $whereCargos $whereEstado
				")->row_array();
				
				$somaTotal = $row['op1'] + $row['op2'] + $row['op3'] + $row['op4'];
				
				// Respostas				
				$retorno["Respostas"] = array(
					$pergunta['op1'] => array(
						"Valor" => (is_null($row['op1'])) ? 0 : $row['op1'],
						"Porcentagem" => ($row['op1'] > 0) ? ($row['op1']/$somaTotal)*100 : 0
					),
					$pergunta['op2'] => array(
						"Valor" => (is_null($row['op2'])) ? 0 : $row['op2'],
						"Porcentagem" => ($row['op2'] > 0) ? ($row['op2']/$somaTotal)*100 : 0
					),
					$pergunta['op3'] => array(
						"Valor" => (is_null($row['op3'])) ? 0 : $row['op3'],
						"Porcentagem" => ($row['op3'] > 0) ? ($row['op3']/$somaTotal)*100 : 0
					),
					$pergunta['op4'] => array(
						"Valor" => (is_null($row['op4'])) ? 0 : $row['op4'],
						"Porcentagem" => ($row['op4'] > 0) ? ($row['op4']/$somaTotal)*100 : 0
					)
				); 
				
				break;
						
			case 4: // Nota
				$row = $this->db->query("
				SELECT AVG(op1) as media
				FROM pesquisa_pergunta_resposta
				LEFT JOIN usuarios_classe ON usuarios_classe.id = pesquisa_pergunta_resposta.idUsuario
				WHERE idPergunta = {$pergunta['id']} $whereCargos $whereEstado
				")->row_array();
				
				// Respostas
				$retorno['Respostas'] = array (
					"Média" => array("Valor" => $row['media'])
				);
				
				break;
		}

		return $retorno;
	}
	
}
?>
<?php
class ConsultoresModel extends Model {
	
	function ver($id = 0) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->result_array();
	}
	
	function detalhar($id = 0) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->row_array();
	}
	
	// Cadastrar um novo Consultor
	function insert($consultor)
	{
		$this->db->insert('consultores', $consultor);
	}
	
	// Verifica se já existe um Email cadastrado no banco
	function verificaEmail($email)
	{
		$this->db->select('email');
		$this->db->from('consultores');
		$this->db->where('email', $email);
		return $this->db->count_all_results();
	}
	
	function verConsultores($start, $limit)
	{
		$this->db->select("*");
		$this->db->from("usuarios_classe");
		$this->db->where("consultor", 2);
		$this->db->order_by('nome');
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function getTotal() {
		$this->db->from("usuarios_classe");
		$this->db->where("consultor", 2);
		return $this->db->count_all_results();
	}
	
	function exibir($letra) 
	{
		$this->db->select('*');
		$this->db->from('consultores');
		$this->db->like('palavra', $letra, 'after'); 
		return $this->db->get()->result_array();
	}
	
	function buscar($letra) 
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where("consultor", 2);
		$this->db->like('nome', $letra, 'after'); 
		return $this->db->get()->result_array();
	}
	
	function buscarConsultor($search) 
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where("consultor", 2);
		$this->db->like('nome', $search, 'match'); 
		//$this->db->orlike('significado', $search, 'match'); 
		return $this->db->get()->result_array();
	}
	
	function listarTodos()
	{
		$query = $this->db->query("	
		SELECT estado.sigla as estado, estado.NOME,	count(*) as total
		FROM usuarios_classe
		
		INNER JOIN mun ON usuarios_classe.cidade = mun.codigo
		INNER JOIN estado ON estado.sigla = mun.ufd_sigla
		
		WHERE consultor = 2
		GROUP BY estado.sigla, estado.nome
		ORDER BY estado.sigla
		");
		
		return $query->result_array();
	}
	
	function listarEstado($estado)
	{
		$query = $this->db->query("	
			SELECT
			usuarios_classe.*,
			cargo.id as o_id,
			cargo.nome as cargo,
			mun.nome as m_nome,
			mun.codigo as m_codigo, 
			mun.ufd_sigla as m_ufd_sigla
			
			FROM usuarios_classe
			INNER JOIN cargo ON usuarios_classe.idOcupacao = cargo.id
			INNER JOIN mun ON usuarios_classe.cidade = mun.codigo
			
			WHERE consultor = 2 and mun.ufd_sigla = '{$estado}'
			ORDER BY usuarios_classe.nome
		");
		return $query->result_array();
	}
	
	// Meu Classe
	function validaLoginConsultor($consultor)
	{
		$this->db->select('*');
		$this->db->from('consultores');
		$this->db->where(array ('email'=> $consultor['email'], 'senha'=> $consultor['senha'])); 
		return $this->db->get()->row_array();
	}
	
	// Atualiza o meu classe
	function updateMeuClasse($idConsultor,$dados)
	{
		$this->db->where('id', $idConsultor);
		$this->db->update('consultores', $dados);
	}
	
	// Guarda a data do último acesso do Consultor
	function update($id)
	{
		$this->db->query("UPDATE consultores SET ultimoAcesso = now() WHERE id = '$id'");
	}
	
	function pesqConsultor($email) 
	{
		return $this->db->get_where('consultores', array('email' => $email))->row_array();
	}
	
	// Retorna a senha a partir do email do usuário
	function retornaSenha($email)
	{
		$this->db->select('email');
		$this->db->from('consultores');
		$this->db->where('email', $email);
		
		return $this->db->get()->row_array();
	}
	
	// Grava a nova senha gerada
	function updateSenha($email, $novaSenha)
	{
		$this->db->query("UPDATE consultores SET senha = md5('$novaSenha') WHERE email = '$email'");
	}
}
?>
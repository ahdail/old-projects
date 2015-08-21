<?php
class UsuarioModel extends Model {
	
	// Exibi as informações do usuário.
	function detalhar($id = 0) 
	{
		return $this->db->get_where('usuarios_classe', array('id' => $id))->row_array();
	}
	
	function verificaDados($id = 0) 
	{
		$this->db->select('nome, avatar, curriculo, cidade, idOcupacao, curriculo');
		$this->db->from('usuarios_classe');
		$this->db->where(array('id' => $id)); 
		return $this->db->get()->row_array();
	}
	
	
	// Cadastrar um novo usuário
	function insert($usuario)
	{
		$this->db->insert('usuarios_classe', $usuario);
		return $this->db->insert_id();
	}
	
	// Guarda a data do último acesso do usuário
	function update($id)
	{
		$this->db->query("UPDATE usuarios_classe SET ultimoAcesso = now() WHERE id = '$id'");
	}
	
	// Verifica se já existe um Email cadastrado no banco
	function verificaEmail($email)
	{
		$this->db->select('email');
		$this->db->from('usuarios_classe');
		$this->db->where('email', $email);
		return $this->db->count_all_results();
	}
	
	// Validar os dados do usuário 
	function validaLogin($usuario)
	{
		$this->db->select('*');
		$this->db->from('usuarios_classe');
		$this->db->where(array ('email'=> $usuario['email'], 'senha'=> $usuario['senha'])); 
		return $this->db->get()->row_array();
	}
	
	function verificaImagem($id) 
	{
		$this->db->select('avatar');
		$this->db->where('id', $id); 
		return $this->db->get('usuarios_classe')->row_array();
	}
	
	// Inseri artigo cadastrado pelo usuário.
	function insertMeuArtigo($meuArtigo)
	{
		$this->db->insert('artigo', $meuArtigo);
	}
	
    // Retorna a senha a partir do email do usuário
	function retornaSenha($email)
	{
		$this->db->select('senha');
		$this->db->from('usuarios_classe');
		$this->db->where('email', $email);
		
		return $this->db->get()->row_array();
	}
	
	// Grava a nova senha gerada
	function updateSenha($email, $novaSenha)
	{
		$this->db->query("UPDATE usuarios_classe SET senha = md5('$novaSenha') WHERE email = '$email'");
	}
	
	function getAutor($idUsuario) {
		$this->db->select('idAutores');
		$this->db->where('id', $idUsuario); 
		$row = $this->db->get('usuarios_classe')->row_array();
		
		return $row['idAutores'];
	}
	
	//Atualiza o meu classe e Dados do meu Classe
	function updateMeuClasse($idUsuario,$dados)
	{
		$this->db->where('id', $idUsuario);
		$this->db->update('usuarios_classe', $dados);
	}
	
	function usuarioPergunta($idUsuario){
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
		$this->db->where("consultoria_perguntas.idUsuario", $idUsuario);
		$this->db->order_by('consultoria_perguntas.id ASC');
		//$this->db->limit(10);
		return $this->db->get()->result_array();
	}
	
	function usuarioComentarioArtigo($email){
		$this->db->select('*');
		$this->db->from('artigo_comentario');
		$this->db->where('email', $email);
		$this->db->where('autorizado', "S");
		return $this->db->get()->result_array();
	}
	
	function meusArtigos($idUsuario){
		$this->db->select('id, titulo, data, resumo, conteudo, acesso, idAutores, bloqueado');
		$this->db->from('artigo');
		$this->db->where('idAutores', $idUsuario);
		$this->db->where('bloqueado', 0);
		$this->db->order_by('id DESC');
		return $this->db->get()->result_array();
	}
	
	function consultoria($idUsuario){
		$this->db->select('p.pergunta, p.id, r.idUsuario, r.data, r.resposta');
		$this->db->from('consultoria_perguntas p');
		$this->db->join('consultoria_respostas r', 'p.id = r.idPergunta');
		$this->db->where('r.idUsuario', $idUsuario);
		$this->db->order_by('id DESC');
		return $this->db->get()->result_array();
	}
	

}
?>
<?php 
set_time_limit(0);

class Importacao extends Controller
{
	// OK até 11/05/09
	function noticias () {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$noticiasOld = $DB2->query("
		SELECT titulo, resumo, data, noticia, fonte, url
		FROM noticias
		ORDER BY data asc
		")->result_array();
		
		$totalLinhas = $DB2->count_all('noticias');
		
		foreach ($noticiasOld as $noticiaOld) {
			$inserir['titulo'] = $noticiaOld['titulo'];
			$inserir['resumo'] = $noticiaOld['resumo'];
			$inserir['data'] = $noticiaOld['data'];
			$inserir['conteudo'] = ($noticiaOld['noticia']) ? $noticiaOld['noticia'] : "";
			$inserir['exibirDestaque'] = 0;
			$inserir['exibirPrincipal'] = "N";
			$inserir['fonte'] = $noticiaOld['fonte'];
			$inserir['sitefonte'] = $noticiaOld['url'];
			$inserir['acesso'] = 0;
			$inserir['comentada'] = "N";
			
			$this->db->insert('noticia', $inserir);
			
			$contador ++;
		}
		
		echo "Total de notícias na base antiga:".$totalLinhas."<br>";
		echo "Total de notícias inseridas: ".$contador;
		
	}
	
	// OK até 11/05/09
	function neopatrimonialismo() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$autoresOld = $DB2->query("
		SELECT titulo, resumo, noticia, data
		FROM noticias
		WHERE tipo like 'n'
		ORDER BY data asc
		")->result_array();
		
		$totalLinhas = $DB2->count_all('noticias');
		
		foreach ($autoresOld as $autorOld) {
			$inserir['titulo'] = $autorOld['titulo'];
			$inserir['resumo'] = $autorOld['resumo'];
			$inserir['conteudo'] = $autorOld['noticia'];
			$inserir['data'] = $autorOld['data'];
			
			$this->db->insert('neo', $inserir);
			
			$contador ++;
			
		}
		
		echo "Total de neopatrimonialismos na base antiga:".$totalLinhas."<br>";
		echo "Total de neopatrimonialismos inseridas: ".$contador;
	}
	
	// OK até 11/05/09
	function autores() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$autoresOld = $DB2->query("
		SELECT id, autor, resumo, email
		FROM autor
		WHERE id > 483
		")->result_array();
		
		$totalLinhas = $DB2->count_all('autor');
		
		foreach ($autoresOld as $autorOld) {
			$inserir['id'] = $autorOld['id'];
			$inserir['nome'] = $autorOld['autor'];
			$inserir['curriculoResumido'] = $autorOld['resumo'];
			$inserir['email'] = $autorOld['email'];
			
			$this->db->insert('autor', $inserir);
			
			$contador ++;
			
		}
		
		echo "Total de autores na base antiga:".$totalLinhas."<br>";
		echo "Total de autores inseridas: ".$contador;
	}
	
	// OK até 11/05/09
	function artigos() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$artigosOld = $DB2->query("
		SELECT titulo, data, resumo, artigo, acessos, autor
		FROM artigos
		ORDER BY data ASC
		")->result_array();
		
		$totalLinhas = $DB2->count_all('artigos');
		
		foreach ($artigosOld as $artigoOld) {
			$inserir['titulo'] = $artigoOld['titulo'];
			$inserir['data'] = $artigoOld['data'];
			$inserir['resumo'] = $artigoOld['resumo'];
			$inserir['conteudo'] = $artigoOld['artigo'];
			$inserir['exibirDestaque'] = 0;
			$inserir['exibirPrincipal'] = "S";
			$inserir['acesso'] = $artigoOld['acessos'];
			$inserir['tipo'] = "A";
			$inserir['idAutores'] = $artigoOld['autor'];
			$inserir['bloqueado'] = 0;
			
			$this->db->insert('artigo', $inserir);
			
			$contador ++;
		}
		
		echo "Total de artigos na base antiga:".$totalLinhas."<br>";
		echo "Total de artigos inseridas: ".$contador;
	}
	
	// OK até 11/05/09
	function usuarios() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$usuariosOld = $DB2->query("
		SELECT DISTINCT nome, mail, estado
		FROM forum_users
		WHERE consultor IS NULL and nome IS NOT NULL and mail IS NOT NULL and id > 400395
		")->result_array();
		
		foreach ($usuariosOld as $usuarioOld) {
			$usuario = $this->db->query("
			SELECT id FROM usuarios_classe WHERE email = '".$usuarioOld['mail']."'"
			)->row_array();
			
			if (!$usuario['id']) {
				$inserir['nome'] = $usuarioOld['nome'];
				$inserir['email'] = $usuarioOld['mail'];
				$inserir['estado'] = $usuarioOld['estado'];
				
				if (strlen($inserir['email']) > 8 and strpos($inserir['email'], "@") > 0) {
					$this->db->insert('usuarios_classe', $inserir);
					
					$contador ++;
				}
			}
		}
		
		echo "Total de usuarios inseridas: ".$contador;
	}
	
	// OK até 11/05/09
	function newsletter() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$usuariosOld = $DB2->query("
		SELECT DISTINCT nome, email, estado, cidade, ocupacao
		FROM newsletter
		WHERE id > 109433 
		LIMIT 10000
		")->result_array();
		
		foreach ($usuariosOld as $usuarioOld) {
			$usuario = $this->db->query("
			SELECT id FROM usuarios_classe WHERE email = '".addslashes($usuarioOld['email'])."'"
			)->row_array();
			
			if (!$usuario['id']) {
				$inserir['nome'] = $usuarioOld['nome'];
				$inserir['email'] = $usuarioOld['email'];
				$inserir['estado'] = $usuarioOld['estado'];
				$inserir['cidade'] = $usuarioOld['cidade'];
				$inserir['idOcupacao'] = $usuarioOld['ocupacao'];
				
				if (strlen($inserir['email']) > 8 and strpos($inserir['email'], "@") > 0) {
					$this->db->insert('usuarios_classe', $inserir);
					
					$contador ++;
				}
			} else {
				$update['cidade'] = $usuarioOld['cidade'];
				$update['idOcupacao'] = $usuarioOld['ocupacao'];
				$this->db->where('id', $usuario['id']);
				$this->db->update('usuarios_classe', $update);
				
				$contador2 ++;
			}
		}
		
		echo "Total de usuarios inseridas: ".$contador;
		echo "<br>";
		echo "Total de usuarios atualizados: ".$contador2;
	}
	
	// OK até 11/05/09
	function consultorUsuarios() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$consultores = $DB2->query("SELECT * FROM consultores WHERE id > 4636")->result_array();
		$totalLinhas = $DB2->count_all('consultores');
		
		foreach ($consultores as $consultor) {
			$inserir['idConsultor'] = $consultor['id'];
			$inserir['consultor'] = 2;
			$inserir['autorizado'] = "S";
			$inserir['nome'] = $consultor['nome'];
			$inserir['email'] = $consultor['mail'];
			$inserir['idOcupacao'] = $consultor['ocupacao'];
			$inserir['cidade'] = $consultor['cidade'];
			$inserir['estado'] = $consultor['estado'];
			$inserir['senha'] = $consultor['pw'];
			$inserir['curriculo'] = $consultor['curriculo'];
			
			$this->db->insert('usuarios_classe', $inserir);
			
			$contador ++;
			
		}
		
		echo "Total de consultores na base antiga:".$totalLinhas."<br>";
		echo "Total de consultores inseridas: ".$contador;
	}
	
	// OK até 11/05/09
	function consultoria() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$perguntasOld = $DB2->query("
		SELECT corpo, data, mail, forum.id
		FROM forum
		INNER JOIN forum_users ON forum.autor = forum_users.id
		WHERE filhode = 0 and data > '2009-04-23 10:55:55'
		ORDER BY forum.id ASC
		LIMIT 30000
		")->result_array();
		
		
		foreach ($perguntasOld as $perguntaOld) {
			$usuario = $this->db->query("
			SELECT id FROM usuarios_classe WHERE email = '".$perguntaOld['mail']."'"
			)->row_array();
			
		/*	$pergunta = $this->db->query("
			SELECT id FROM consultoria_perguntas WHERE id = ".$perguntaOld['id']
			)->row_array();*/
			
			if ($usuario['id']) {
				$inserir['id'] = $perguntaOld['id'];
				$inserir['idTema'] = 18;
				$inserir['idUsuario'] = $usuario['id'];
				$inserir['data'] = $perguntaOld['data'];
				$inserir['pergunta'] = $perguntaOld['corpo'];
				
				$this->db->insert('consultoria_perguntas', $inserir);
				
				$contador ++;
			}
		}
		
		
		echo "Total de perguntas inseridas: ".$contador;
		// Importa as respostas
	}
	
	// OK até 11/05/09
	function consultoriaRespostas() {
		// Carrega o database de importacao
		$DB2 = $this->load->database('importacao', true);
		
		$respostasOld = $DB2->query("
		SELECT corpo, data, forum.id, forum_users.consultor, filhode
		FROM forum
		INNER JOIN forum_users ON forum.autor = forum_users.id
		WHERE filhode > 0 and forum.data > '2009-04-23 14:32:46' and consultor IS NOT NULL
		ORDER BY forum.id ASC
		LIMIT 20000
		")->result_array();
		
		
		foreach ($respostasOld as $respostaOld) {
			$usuario = $this->db->query("
			SELECT id FROM usuarios_classe WHERE idConsultor = ".$respostaOld['consultor']
			)->row_array();
			
			if ($usuario['id']) {
				$inserir['idPergunta'] = $respostaOld['filhode'];
				$inserir['idUsuario'] = $usuario['id'];
				$inserir['data'] = $respostaOld['data'];
				$inserir['resposta'] = $respostaOld['corpo'];
				
				$this->db->insert('consultoria_respostas', $inserir);
				
				$contador ++;
			}
		}
		
		
		echo "Total de respostas inseridas: ".$contador;
		// Importa as respostas
	}
	
	function limpaUsuariosDuplicados() {
		$senhaDefault = md5('Y2xhc3NI');
		echo $senhaDefault;
		die();
		
		// Pega os usuarios duplicados
		$usuarios = $this->db->query("
		SELECT email, count( * )
		FROM usuarios_classe
		GROUP BY email
		HAVING count( * ) > 1
		")->result_array();
		
		foreach ($usuarios as $usuario) {
			// Pega o primeiro ID pra esse email
			$usuarioDados = $this->db->query("
			SELECT id
			FROM usuarios_classe
			WHERE email = '{$usuario['email']}'
			ORDER BY consultor DESC
			LIMIT 1			
			")->row_array();

			// Deleta os outros usuarios 
			$this->db->query("
			DELETE FROM usuarios_classe
			WHERE email = '{$usuario['email']}' and id <> {$usuarioDados['id']}
			");
			
			// Muda a senha do ID salvo
			$this->db->query("
			UPDATE usuarios_classe SET senha='{$senhaDefault}' WHERE id={$usuarioDados['id']}
			");
		}
		
		echo "Limpagem efetuada com sucesso!";
	}
	
	function enviaEmail() {
		// Carrega as libs
		$this->load->library("enviarmail");
		$this->load->helper('random_keys');

		// Pega um usuário
		$usuarios = $this->db->query("
		SELECT id, email, nome
		FROM usuarios_classe
		WHERE senha = ''
		")->result_array();
		
		foreach($usuarios as $usuario) {
			$usuario['senha'] = randomKeys(6);
			$usuario['data'] = date("d/m/Y");
			$usuario['link'] = base_url()."login/validar";
	 
			// Monta a mensagem e envia o email
			$mensagem = $this->load->view('importacaoEmail', $usuario, true);
	
			$this->enviarmail->carregar($usuario['email'],"retornotreinamentos@gmail.com","Atualização de cadastro",$mensagem);
			$this->enviarmail->enviar();
			
			// Atualiza a senha do usuário
			$this->db->query("UPDATE usuarios_classe SET senha = '".md5($usuario['senha'])."' WHERE id = {$usuario['id']}");
			
			//delay de 0.5 segundo:
			usleep (500000);
		}
	}
}
?>
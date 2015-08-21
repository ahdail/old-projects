<?php
class BoletimModel extends Model {

	function insertBoletimAux($data)
	{
		$this->db->set('enviada', 'N');
		$this->db->set('data_criacao', $data);
		$this->db->insert('boletim_aux');
	}

	function ultimoBoletim()
	{
		$this->db->select('*');
		$this->db->from("boletim_aux");
		$this->db->order_by("id desc");
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function verBoletim($id)
	{
		$this->db->select('*');
		$this->db->from("boletim_aux");
		$this->db->where("id", $id);
		return $this->db->get()->row_array();
	}

	function verNoticiaBoletim($id)
	{

		$this->db->select('n.id,n.titulo,n.resumo,n.data,n.exibirDestaque');
		$this->db->from('noticia as n');
		$this->db->join('boletim as b', 'n.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"N");
		return $this->db->get()->result_array();
	}

	function verJuizoBoletim($id)
	{

		$this->db->select('j.id,j.pergunta');
		$this->db->from('juizo_diario as j');
		$this->db->join('boletim as b', 'j.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"J");
		return $this->db->get()->result_array();
	}

	function verArtigoBoletim($id)
	{

		$this->db->select('a.id,a.titulo,a.resumo,a.data,a.exibirDestaque');
		$this->db->from('artigo as a');
		$this->db->join('boletim as b', 'a.id = b.id_tipo ', 'left');
		$this->db->where('id_boletim_aux',$id);
		$this->db->where('b.tipo',"A");
		return $this->db->get()->result_array();
	}

	function todosBoletins()
	{
		$this->db->select('id');
		$this->db->from("boletim_aux");
		$this->db->order_by("id desc");
		return $this->db->get()->result_array();
	}

	function insertBoletimJuizo($ultimoID,$juizo_id)
	{
		foreach ($juizo_id as $idJuizo):
			$valores = array('id_boletim_aux' => $ultimoID,'id_tipo' => $idJuizo, "tipo" => "J");
			$this->db->insert('boletim', $valores);
		endforeach;
	}

	function insertBoletimNoticia($ultimoID,$noticia_id)
	{
		foreach ($noticia_id as $idNoticia):
			$valores = array('id_boletim_aux' => $ultimoID,'id_tipo' => $idNoticia, "tipo" => "N");
			$this->db->insert('boletim', $valores);
		endforeach;
	}

	function insertBoletimArtigo($ultimoID,$artigo_id)
	{
		foreach ($artigo_id as $idArtigo):
			$valores = array('id_boletim_aux' => $ultimoID,'id_tipo' => $idArtigo, "tipo" => "A");
			$this->db->insert('boletim', $valores);
		endforeach;
	}

	function noticiaData($diaMesAnoI,$diaMesAnoF)
	{
		$this->db->select("id, titulo, resumo, data, conteudo,exibirDestaque");
		$this->db->from("noticia");
		$array = array('data >=' => $diaMesAnoI, 'data <=' => $diaMesAnoF);
		$this->db->where($array);
		return $this->db->get()->result_array();

	}

	function artigoData($diaMesAnoI,$diaMesAnoF)
	{
		$this->db->select("id, titulo, resumo, data, conteudo, tipo,exibirDestaque");
		$this->db->from("artigo");
		$array = array('data >=' => $diaMesAnoI, 'data <=' => $diaMesAnoF , 'tipo = ' => "A");
		$this->db->where($array);
		return $this->db->get()->result_array();

	}

	function juizoData()
	{
		$this->db->select('id,pergunta');
		$this->db->from('juizo_diario');
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get()->result_array();

	}

	function todosEmail()
	{
		$this->db->select('email');
		$this->db->from('usuarios_classe');
		$this->db->limit(10);
		return $this->db->get()->result_array();
	}

	function statusEnvio($idBoletim)
	{
		$data = array(
               'enviada' => "S",
            );
		$this->db->update('boletim_aux', $data, array('id' => $idBoletim));
	}


}
?>
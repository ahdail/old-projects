<?php
class consignatarioModel extends Model {
	
	private $vet_dados = array();

    public function __construct() {
        
		parent::Model();
    }

	public function detalhe() {
		
		$dados = $this->getNoticia($this->uri->segment(3));
		$this->vet_dados["dados"] = array($dados);
		return $this->vet_dados["dados"];
	}
	
	public function getNoticia($id=null) {
		
		if ($id != null) {//se passar um id ele busca apenas um registro
			$query = $this->db->query("SELECT * FROM noticia WHERE id_noticia = {$id}");
			return $query->row();
		} 
		
    }

	function exibir($start, $limit) {
		
		$query = $this->db->query("SELECT * FROM noticia Limit $start, $limit");
		return $query->result();
	}
	
	function getTotal() {
	
		return $this->db->count_all('noticia');
		
	}
}
?>
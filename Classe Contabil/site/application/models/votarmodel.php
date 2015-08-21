<?php
class VotarModel extends Model{
	
	function insert ($idResposta,$idPergunta)
    {
        $this->db->set('idResposta', $idResposta);
        $this->db->set('idPergunta', $idPergunta);
		$this->db->insert('enquete_votacao'); 
    }
    
    
    
}
?>
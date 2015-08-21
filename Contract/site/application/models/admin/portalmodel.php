<?php
class PortalModel extends CI_Model {
	
	
	
	function Projetos()
	{
		$this->db->select('*');
		$this->db->from('noticia');
		//$this->db->where('exibir', 'N');
		$this->db->order_by("id DESC");
		$this->db->limit(3);
		return $this->db->get()->result_array();		
	}
	
	function Cronograma()
	{
		$this->db->select('*');
		$this->db->from('noticia');
		//$this->db->where('exibir', 'N');
		$this->db->order_by("id DESC");
		$this->db->limit(3);
		return $this->db->get()->result_array();		
	}
	
	function planoAcao()
	{
		
		$this->db->select('ACAO, ENTREGA, CAUSA, RESPONSAVEL, DATA_INICIAL, DATA_PREVISTA, DATA_REPROGRAMADA, STATUS_PLANO');
		$this->db->from('PROJETO_PLANO_ACAO');
		//$this->db->where('ID_PROJETO', $id_projeto);
		return $this->db->get()->result_array();		
	}
	
	function atividades()
	
	{	
		$this->db->select('DATA_ATIVIDADES, DESCRICAO_ATIVIDADES, TIPO_ATIVIDADES');
		$this->db->from('PROJETO_ATIVIDADES');
		//$this->db->where('ID_PROJETO_REPORT');
		$this->db->where('TIPO_ATIVIDADES','P');
		$this->db->limit(3);
		return $this->db->get()->result_array();
	}
	
	function melistones()
	
	{
	
	
		$sql="SELECT PM.ID_PROJETO_MARCOS 			   AS ID_PROJETO_MARCOS,
       					 PM.ID_MARCO 						   AS ID_MARCO,
      					 PM.ID_PROJETO_REPORT 				   AS ID_PROJETO_REPORT,
       					 PBM.DEN_BASELINE_MARCOS 			   AS DEN_BASELINE_MARCOS,
       					 PM.DATA_INICIAL_PROJETO_MARCOS 	   AS DATA_INICIAL_PROJETO_MARCOS,
       					 PM.DATA_REPLANEJAMENTO_PROJETO_MARCOS AS DATA_REPLANEJAMENTO_PROJETO_MARCOS,
       					 PM.PERCENTUAL_PROJETO_MARCOS 		   AS PERCENTUAL_PROJETO_MARCOS
				  FROM eproj.PROJETO_BASELINE_MARCOS PBM,
     					 eproj.PROJETO_MARCOS PM,
     					 eproj.PROJETO_REPORT PR
				  WHERE PR.ID_PROJETO = PBM.ID_PROJETO 				AND
      					PR.ID_PROJETO_REPORT = PM.ID_PROJETO_REPORT AND
      					PBM.ID_BASELINE_MARCOS = PM.ID_MARCO 		AND
      					PBM.VERSAO = PM. VERSAO 					AND
						PM.ID_PROJETO_REPORT = '1'
					ORDER BY ID_PROJETO_MARCOS ASC";
		return $mar = $this->db->query($sql)->result_array();
	
	
	}
	


}
?>
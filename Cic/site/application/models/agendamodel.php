<?php
class AgendaModel extends Model {
	
	function detalhar($id) 
	{
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
	function getTotal() 
	{
		return $this->db->count_all('evento');
	}
	
	function exibir($data=false)
	{
		$mesesArray = array(
			1 => 'Janeiro',
			2 => 'Fevereiro',
			3 => 'Março',
			4 => 'Abril',
			5 => 'Maio',
			6 => 'Junho',
			7 => 'Julho',
			8 => 'Agosto',
			9 => 'Setembro',
			10 => 'Outubro',
			11 => 'Novembro',
			12 => 'Dezembro'
		);
		
		$i = 0;

		// Percorre os meses
		$meses = $this->listarMes($data);
		foreach ($meses as $mesRow) {
			$retorno[$i]['mes'] = $mesesArray[$mesRow['mes']];
			
			// Percorre os eventos deste mes
			$eventos = $this->listarEventos($mesRow['mes'], date('Y'), $data);
			
			$retorno[$i]['eventos'] = $eventos;
			
			$i++;
		}
		return $retorno;
	}
	
	function listarMes($data=false) {
		$this->db->select('MONTH(data) as mes');
		$this->db->from('evento');
		if ($data) {
			$this->db->where('data', $data);
		} else {
			$this->db->where('YEAR(data) = '.date('Y'), NULL, FALSE);
		}
		$this->db->order_by('data');
		$this->db->group_by('mes');
		return $this->db->get()->result_array();
	}
	
	function listarEventos($mes, $ano, $data=false) {
		$this->db->select('*');
		$this->db->from('evento');
		if ($data) {
			$this->db->where('data', $data);
		} else {
			$this->db->where("MONTH(data) = {$mes} and YEAR(data) = {$ano}", NULL, FALSE);
		}
		$this->db->order_by('data');
		return $this->db->get()->result_array();
	}
	
}
?>
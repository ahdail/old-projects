<?php
class EventoModel extends Model {

	var $conf;
	
	function detalhar($id) {
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
	function detalharData($data) {
		return $this->db->get_where('evento', array('data' => $data))->row_array();
		//print_r($a);
		//die();
	}
	
	function insert($evento)
	{
		$this->db->insert('evento', $evento);
	}
	
	function deletar($id)
	{
		$this->db->delete('evento', array('id' => $id));
	}
	
	function update($idConteudo,$evento)
	{
		$this->db->where('id', $idConteudo);
		$this->db->update('evento', $evento);
	}
	
	function getTotal() {
		return $this->db->count_all('evento');
	}
	
	function exibir($start, $limit)
	{
		$this->db->select('*');
		$this->db->from('evento');
		$this->db->order_by("data desc");
		$this->db->limit($limit, $start);
		return $this->db->get();
	}
	
	function exibirData($id = 0)
	{
		$this->db->select('data');
		return $this->db->get_where('evento', array('id' => $id))->row_array();
	}
	
	function ultimosEventos () 
	{
		$this->db->select('*');
		$this->db->from('evento');		
		$this->db->order_by("data desc");
		$this->db->limit(1);		
		return $this->db->get()->row_array();
	}
	
	function ultimos10() 
	{
	
		$year = date('Y');
		$month = date('m');
		
		$this->db->select('*');
		$this->db->from('evento');	
		
		$this->db->not_like('data', "$year-$month", 'after');
		//$this->db->where('data', $idConteudo);
		
		$this->db->order_by("data DESC");
		$this->db->limit(10);		
		return $this->db->get()->result_array();
	}
	
	function todosEventos()
	{
		$this->db->select('id, titulo, data');
		$this->db->from('evento');	
		$this->db->order_by("data DESC");		
		return $this->db->get()->result_array();
	}
	
	function datasEventos()
	{
		$this->db->select('data');
		$this->db->from('evento');	
		$this->db->order_by("data DESC");		
		return $this->db->get()->result_array();
	}
	
	
	function get_calendar_data($year, $month) {
		
		$query = $this->db->select('data')->from('evento')
			->like('data', "$year-$month", 'after')->order_by("data ASC")->get();
			
		$cal_data = array();
		
		foreach ($query->result() as $row) {
			$cal_data[intval(substr($row->data,8,2))] = base_url().'evento/show/'.$row->data;
		}
		return $cal_data;
		//print_r($cal_data);
		//die();
		
	}
	
	function generate ($year, $month) {
		
		$this->conf = array(
			'start_day' => 'monday',
			'day_type' => 'short',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'evento/preview'
		);
		
		$this->conf['template'] = '
			{table_open}<table border="0" style="font-size:12px; background:#CCBB90; border-right:1px solid #5E0E11; border-top:1px solid #5E0E11; border-bottom:1px solid #5E0E11; border-left:1px solid #5E0E11;color:#5E0E11"; cellpadding="5" cellspacing="3" class="calendar">{/table_open}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr>{/cal_row_start}
			{cal_cell_start}<td>{/cal_cell_start}
   
			
   
			{cal_cell_content}<a href="{content}" style="background-color:#ffffff">{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="highlight" ><a href="{content}">{day}</a></div>{/cal_cell_content_today}
		   
			{cal_cell_no_content}{day}{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="highlight" style="color:#5D0E11; font-weight:bold">{day}</div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';
		
		$this->load->library('calendar', $this->conf);
		
		$cal_data = $this->get_calendar_data($year, $month);
		
		
		
		
		
		return $this->calendar->generate($year, $month, $cal_data);
		
		
	}
	
	
}
?>
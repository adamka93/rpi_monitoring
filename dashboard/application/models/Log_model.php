<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}
	public function last_temp(){
		$this->db->select('measure_date, temp');
		$this->db->from('cpu_temp');	
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function last_cpu(){
		$this->db->select('measure_date, cpu0, cpu1, cpu2, cpu3');
		$this->db->from('cpu_usage');	
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function last_memory(){
		$this->db->select('measure_date, memory');
		$this->db->from('memory_usage ');	
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function last_disc(){
		$this->db->select('measure_date, disk');
		$this->db->from('disk_usage');	
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getCpuTemperature(){
		$this->db->select('measure_date, cpu_temp as temp');
		$this->db->from('log');	
		$this->db->order_by('measure_date', 'DESC');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getLogInIntervall($hw, $start, $end){
		$this->db->select("*");
		$this->db->from($hw);
		$this->db->where("measure_date >=", $start);
		$this->db->where("measure_date <=", $end);
		
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getLastBefore($hw, $start){
		$this->db->select("*");
		$this->db->from($hw);
		$this->db->where("measure_date <=", $start);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result_array();
	}
}








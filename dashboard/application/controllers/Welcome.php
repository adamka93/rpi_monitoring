<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('log_model');

	}
	public function index()
	{
		$data['temps'] = json_encode($this->log_model->getCpuTemperature());
		$data['last_temp'] = $this->log_model->last_temp();
		$data['last_cpu'] = $this->log_model->last_cpu();
		$data['last_memory'] = $this->log_model->last_memory();
		$data['last_disc'] = $this->log_model->last_disc();
		$this->load->view('welcome_message', $data);
	}

	public function temps()
	{
		echo json_encode($this->log_model->getCpuTemperature());
	}

	public function allPage(){
		$retrn = [];

		$start = $this->input->get("start");
		$end = $this->input->get("end");

		if(!$start || !$end)
			return "{}";

		$retrn['cpu'] = [];
		$retrn['cpu']['data'] = $this->log_model->getLogInIntervall("cpu_temp", $start, $end);
		$retrn['cpu']['before'] = $this->log_model->getLastBefore("cpu_temp", $start);

		$retrn['cpuu']['data'] = $this->log_model->getLogInIntervall("cpu_usage", $start, $end);
		$retrn['cpuu']['before'] = $this->log_model->getLastBefore("cpu_usage", $start);

		$retrn['hdd']['data'] = $this->log_model->getLogInIntervall("disk_usage", $start, $end);
		$retrn['hdd']['before'] = $this->log_model->getLastBefore("disk_usage", $start);

		$retrn['ram']['data'] = $this->log_model->getLogInIntervall("memory_usage", $start, $end);
		$retrn['ram']['before'] = $this->log_model->getLastBefore("memory_usage", $start);

		//todo: itt kell a többit is majd
		echo json_encode($retrn);
	}
}

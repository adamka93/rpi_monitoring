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
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalt extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jadwal_model');
		$this->load->library('form_validation');
		$this->load->library('pdf');
	}

	public function index()
	{
		$data['jadwal']=$this->Jadwal_model->getAllJadwal();
		
		if ($this->input->post('keyword'))
		{
			$data['jadwal']= $this->Jadwal_model->cariDataJadwal();
		}
		$this->load->view('templates/headert');
		$this->load->view('jadwal/t',$data);
		$this->load->view('templates/footert');
	}
}
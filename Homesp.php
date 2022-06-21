<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homesp extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
    }

	public function index()
	{
		//$data=array();
		//foreach($this->Home_model->get()->result_array() as $row)
        //$data[] = (int) $row['id_langganan'];
	
		$data['chartXjadwal']=$this->Home_model->getRekapJadwalX();
		$data['chartYjadwal']=$this->Home_model->getRekapJadwalY();
		$data['chartXYTeknisi']=$this->Home_model->getRekapTeknisiXY();
		$data['chartXYPelanggan']=$this->Home_model->getRekapPelangganXY();
		$data['chartXYKategori']=$this->Home_model->getRekapKategoriXY();
		$this->load->view('templates/headersp');
		$this->load->view('home/sp', $data);
		$this->load->view('templates/footersp');
	}
}
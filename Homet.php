<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homet extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
    }

	public function index()
	{
		$data['chartXjadwal']=$this->Home_model->getRekapJadwalX();
		$data['chartYjadwal']=$this->Home_model->getRekapJadwalY();
		$data['chartXYTeknisi']=$this->Home_model->getRekapTeknisiXY();
		$data['chartXYPelanggan']=$this->Home_model->getRekapPelangganXY();
		$data['chartXYKategori']=$this->Home_model->getRekapKategoriXY();

		$this->load->view('templates/headert');
		$this->load->view('home/t',$data);
		$this->load->view('templates/footert');
	}
}
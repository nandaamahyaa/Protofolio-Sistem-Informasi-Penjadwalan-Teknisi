<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecs extends CI_Controller {
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
		$this->load->view('templates/headercs');
		$this->load->view('home/cs',$data);
		$this->load->view('templates/footercs');
	}
}
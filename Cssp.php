<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cssp extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cs_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['costumer_servis']=$this->Cs_model->getAllCs();
		$this->load->view('templates/headersp');
		$this->load->view('cs/sp',$data);
		$this->load->view('templates/footersp');
	}
	
	public function tambah()
	{
		$data['costumer_servis']=$this->Cs_model->getAllCs();
		$this->form_validation->set_rules('id_cs','ID Cs','required');
		$this->form_validation->set_rules('nama','Nama Cs','required');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headersp');
					$this->load->view('cs/tambahsp',$data);
					$this->load->view('templates/footersp');
                }
           else
                {
                    $this->Cs_model->tambahDataCs();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('sp/Cssp');
                }
    }
	public function ubah($id_cs)
	{
		$data['costumer_servis']=$this->Cs_model->getCsById($id_cs);
		$this->form_validation->set_rules('id_cs','ID Cs','required');
		$this->form_validation->set_rules('nama','Nama Cs','required');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headersp');
					$this->load->view('cs/ubahsp',$data);
					$this->load->view('templates/footersp');
                }
           else
                {
                    $this->Cs_model->ubahDataCs();
					$this->session->set_flashdata('flash','DiUbah');
					redirect('sp/Cssp');
                }
     }
	public function hapus($id_cs)
	{
		$this->Cs_model->hapusDataCs($id_cs);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('sp/Cssp');
	}
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknisisp extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Teknisi_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['teknisi']=$this->Teknisi_model->getAllTeknisi();
		if ($this->input->post('keyword'))
		{
			$data['teknisi']= $this->Teknisi_model->cariDataTeknisi();
		}
		$this->load->view('templates/headersp');
		$this->load->view('teknisi/sp',$data);
		$this->load->view('templates/footersp');
	}
	public function tambah()
	{
		$data['newidTeknisi']= $this->Teknisi_model->getNewIdTeknisi();
		$data['teknisi']=$this->Teknisi_model->getAllTeknisi();
		
		$this->form_validation->set_rules('id_teknisi','ID Teknisi','required');
		$this->form_validation->set_rules('nama_teknisi','Nama Teknisi','required');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headersp');
					$this->load->view('teknisi/tambahsp',$data);
					$this->load->view('templates/footersp');
                }
           else
                {
                    $this->Teknisi_model->tambahDataTeknisi();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('sp/Teknisisp');
                }
     }
	public function ubah($id_teknisi)
	{
		$this->form_validation->set_rules('id_teknisi','ID Teknisi','required');
		$this->form_validation->set_rules('nama_teknisi','Nama Teknisi','required');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		
		$data['teknisi']=$this->Teknisi_model->getTeknisiById($id_teknisi);
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headersp');
					$this->load->view('teknisi/ubahsp',$data);
					$this->load->view('templates/footersp');
                }
           else
                {
                    $this->Teknisi_model->ubahDataTeknisi();
					$this->session->set_flashdata('flash','DiUbah');
					redirect('sp/Teknisisp');
                }
     }
	 
	 public function hapus ($id_teknisi)
	 {
		 $this->Teknisi_model->hapusDataTeknisi($id_teknisi);
		 $this->session->set_flashdata('flash','Dihapus');
		redirect('sp/Teknisisp');
	 }
	 
	
}
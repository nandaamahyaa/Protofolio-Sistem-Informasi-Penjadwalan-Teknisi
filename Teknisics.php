<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknisics extends CI_Controller {
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
		$this->load->view('templates/headercs');
		$this->load->view('teknisi/cs',$data);
		$this->load->view('templates/footercs');
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
					$this->load->view('templates/headercs');
					$this->load->view('teknisi/tambahcs',$data);
					$this->load->view('templates/footercs');
                }
           else
                {
                    $this->Teknisi_model->tambahDataTeknisi();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('cs/Teknisics');
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
					$this->load->view('templates/headercs');
					$this->load->view('teknisi/ubahcs',$data);
					$this->load->view('templates/footercs');
                }
           else
                {
                    $this->Teknisi_model->ubahDataTeknisi();
					$this->session->set_flashdata('flash','DiUbah');
					redirect('cs/Teknisics');
                }
     }
	 
	 
	
}
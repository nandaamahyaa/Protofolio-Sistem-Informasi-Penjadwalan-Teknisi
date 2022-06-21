<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggancs extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pelanggan_model');
		$this->load->library('form_validation');
        $this->load->library('pagination');
	}

	public function index()
	{
		$data['pelanggan']=$this->Pelanggan_model->getDataPelangganAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['pelanggan']= $this->Pelanggan_model->cariDataDataPelanggan();
		}
		$this->load->view('templates/headercs');
		$this->load->view('pelanggan/cs',$data);
		$this->load->view('templates/footercs');
		
    }
	public function tambah()
	{
		$data['newidPelanggan']= $this->Pelanggan_model->getNewIdPelanggan();
		$data['newidLangganan']= $this->Pelanggan_model->getNewIdLangganan();
		
		$data['pelanggan']=$this->Pelanggan_model->getPelangganAll();
		$data['paket']= $this->Pelanggan_model->getAllPaket();
		$data['jenis_pelanggan']= $this->Pelanggan_model->getAllJenisPelanggan();
		
		$this->form_validation->set_rules('id_pelanggan',' ID Pelanggan','required');
		$this->form_validation->set_rules('nama','Nama Pelanggan','required');
		$this->form_validation->set_rules('No_Telp','No Telp','numeric');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headercs');
					$this->load->view('pelanggan/tambahcs',$data);
					$this->load->view('templates/footercs');
                }
           else
                {
                    $this->Pelanggan_model->tambahDataPelanggan();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('cs/Pelanggancs');
					
                }
    }
	
	public function ubah($id_pelanggan)
	{	
		
		$data['pelanggan']=$this->Pelanggan_model->getPelangganById($id_pelanggan);
		$data['paket']= $this->Pelanggan_model->getAllPaket();
		$data['jenis_pelanggan']= $this->Pelanggan_model->getAllJenisPelanggan();
		
		$this->form_validation->set_rules('id_pelanggan',' ID Pelanggan','required');
		$this->form_validation->set_rules('nama','Nama Pelanggan','required');
		$this->form_validation->set_rules('No_Telp','No Telp','numeric');
		$this->form_validation->set_rules('No_HP','No Hp','numeric');
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headercs');
					$this->load->view('pelanggan/ubahcs',$data);
					$this->load->view('templates/footercs');
                }
           else
                {
                    $this->Pelanggan_model->ubahDataPelanggan();
					$this->session->set_flashdata('flash','Diubah');
					redirect('cs/Pelanggancs');
                }
    }
	
	public function hapus ($id_pelanggan)
	{
		$this->Pelanggan_model->hapusDataPelanggan($id_pelanggan);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('cs/Pelanggancs');
	}
	 
	public function internet()
	{
		$data['pelanggan']=$this->Pelanggan_model->getPelangganAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['pelanggan']= $this->Pelanggan_model->cariDataPelanggan();
		}
		$this->load->view('templates/headercs');
		$this->load->view('pelanggan/cs',$data);
		$this->load->view('templates/footercs');
		
        $data['pagination'] = $this->pagination->create_links();
    }
	 
	 public function project()
	{
		$data['pelanggan']=$this->Pelanggan_model->getPelangganAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['pelanggan']= $this->Pelanggan_model->cariDataPelanggan();
		}
		$this->load->view('templates/headercs');
		$this->load->view('pelanggan/cs',$data);
		$this->load->view('templates/footercs');
		
        $data['pagination'] = $this->pagination->create_links();
    }
	 
	public function lainnya()
	{
		$data['pelanggan']=$this->Pelanggan_model->getPelangganAll();
		
		if ($this->input->post('keyword'))
		{
			$data['pelanggan']= $this->Pelanggan_model->cariDataPelanggan();
		}
		$this->load->view('templates/headercs');
		$this->load->view('pelanggan/cs',$data);
		$this->load->view('templates/footercs');
    }
}
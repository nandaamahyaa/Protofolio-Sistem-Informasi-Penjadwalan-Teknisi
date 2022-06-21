<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalsp extends CI_Controller {
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
		$this->load->view('templates/headersp');
		$this->load->view('jadwal/sp',$data);
		$this->load->view('templates/footersp');
	}

	public function tambah()
	{
		$data['newidJadwal']= $this->Jadwal_model->getNewIdJadwal();
		$data['newidPenugasan']= $this->Jadwal_model->getNewIdPenugasan();
		
		$data['jadwal']=$this->Jadwal_model->getAllJadwal();
		$data['pelanggan']= $this->Jadwal_model->getAllPelanggan();
		$data['teknisi']= $this->Jadwal_model->getAllTeknisi();
		
		$this->form_validation->set_rules('id_langganan','Nama Pelanggan','required');
		
		if ($this->form_validation->run() == FALSE)
            {
				$this->load->view('templates/headersp');
				$this->load->view('jadwal/tambahsp',$data);
				$this->load->view('templates/footersp');
            }
          else
              {
                    $this->Jadwal_model->tambahDataJadwal();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('sp/Jadwalsp');
					
            }
    }
	
	public function ubah($id_jadwal)
	{	
		
		$data['jadwal']=$this->Jadwal_model->getJadwalById($id_jadwal);
		
		$data['Teknisi']=$this->Jadwal_model->getTeknisiByJadwalId($id_jadwal);
		$data['JmlTeknisi']=count($this->Jadwal_model->getTeknisiByJadwalId($id_jadwal));
		
		$data['pelanggan']= $this->Jadwal_model->getAllPelanggan();
		$data['AllTeknisi']= $this->Jadwal_model->getAllTeknisi();
		
		
		$this->form_validation->set_rules('id_langganan','Nama','required');
		
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headersp');
					$this->load->view('jadwal/ubahsp',$data);
					$this->load->view('templates/footersp');
                }
           else
                {
                    $this->Jadwal_model->ubahDataJadwal();
					$this->session->set_flashdata('flash','Diubah');
					redirect('sp/Jadwalsp');
                }
    }
	public function hapus ($id_jadwal)
	{
		$this->Jadwal_model->hapusDataJadwal($id_jadwal);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('sp/Jadwalsp');
	}
	
	public function cetak(){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(298,7,'REKAP PENJADWALAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(298,7,'PT BONET UTAMA',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(16,9,'',0,1);
        $pdf->SetFont('Arial','B',12 );
		$pdf->Cell(28,9,'Tanggal',1,0);
		$pdf->Cell(153,9,'NAMA Pelanggan',1,0);
        $pdf->Cell(55,9,'Tujuan',1,0);
        $pdf->Cell(40,9,'Nama Teknisi',1,1);
        $pdf->SetFont('Arial','',10);
		$jadwal = $this->Jadwal_model->getJadwalAll();
		//$id = $row["id_jadwal"];
				//$penugasan = $this->Jadwal_model->getPenugasanByIdJadwal($id);
				//$a.=foreach($penugasan as $teknisi){ $teknisi['nama_panggilan']}
        foreach ($jadwal  as $row){				 	
            $pdf->Cell(28,9,$row['tanggal'],1,0);
			$pdf->Cell(153,9,$row['nama'],1,0);
            $pdf->Cell(55,9,$row['tujuan'],1,0);
			
			$id = $row["id_jadwal"];
			$penugasan = $this->Jadwal_model->getPenugasanByIdJadwal($id);
			$namaPanggil =  '';
			
			foreach($penugasan as $teknisi){ 
			  $namaPanggil .= $teknisi['nama_panggilan'] . ','; 
			}
			
			//echo $namaPanggil;
			
			$pdf->Cell(40,9,$namaPanggil,1,1);
				}
        $pdf->Output();
    }
}
<?php

class Home_model extends CI_Model
{	
	public function getRekapJadwalX()
    {
		$this->db->order_by('jadwal.tanggal','asc');
		$this->db->group_by("DATE_FORMAT(jadwal.tanggal, '%b')");
		$this->db->where('jadwal.tanggal between (CURDATE() - INTERVAL 5 MONTH) and (CURDATE() - INTERVAL 1 DAY)');
		$this->db->join('jadwal', 'jadwal.id_jadwal = penugasan.id_jadwal');
		$this->db->from('penugasan');
		$this->db->select("DATE_FORMAT(jadwal.tanggal, '%b') AS bulan");
		return $this->db->get()->result_array();
	}
	public function getRekapJadwalY()
    {
		$this->db->order_by('jadwal.tanggal','asc');
		$this->db->group_by("DATE_FORMAT(jadwal.tanggal, '%b')");
		$this->db->where('jadwal.tanggal between (CURDATE() - INTERVAL 5 MONTH) and (CURDATE() - INTERVAL 1 DAY)');
		$this->db->join('jadwal', 'jadwal.id_jadwal = penugasan.id_jadwal');
		$this->db->from('penugasan');
		$this->db->select("count(*) AS jumlah");
		return $this->db->get()-> result_array();
	}
	
	public function getRekapTeknisiXY()
    {
		$this->db->group_by("nama_panggilan");
		$this->db->where('tanggal between (CURDATE() - INTERVAL 5 MONTH) and (CURDATE() - INTERVAL 1 DAY)');
		$this->db->join('jadwal', 'jadwal.id_jadwal = penugasan.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('penugasan');
		$this->db->select("nama_panggilan, count(*) AS jumlah");
		return $this->db->get()-> result_array();
	}
	
	public function getRekapPelangganXY()
    {
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->from('pelanggan');
		$this->db->select("nama, count(*) AS jumlah");		
		return $this->db->get()-> result_array();
	}
	
	public function getRekapKategoriXY()
    {
		$this->db->group_by("kategori_layanan");
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->from('pelanggan');
		$this->db->select("kategori_layanan, count(*) AS jumlah");		
		return $this->db->get()-> result_array();
	}
}
	
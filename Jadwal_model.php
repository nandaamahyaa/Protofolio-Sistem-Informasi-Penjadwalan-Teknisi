<?php

class Jadwal_model extends CI_model {
	
	public function getAllJadwal()
	{	
		$halamanKe = $this->uri->segment('4') != NULL ? $this->uri->segment('4') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);
		$this->db->order_by('jadwal.tanggal','desc');
		$this->db->group_by('jadwal.id_jadwal');
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('jadwal');
		$this->db->select("penugasan.id_penugasan, DATE_FORMAT(jadwal.tanggal, '%d %b %Y') AS tanggal, pelanggan.nama, jenis_pelanggan.jenis_pelanggan, paket.nama_paket,penugasan.tujuan, teknisi.nama_panggilan, jadwal.id_jadwal");
		return $this->db->get()-> result_array();
	}
	public function getJadwalAll()
	{	
		$this->db->order_by('jadwal.tanggal','desc');
		$this->db->group_by('jadwal.id_jadwal');
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('jadwal');
		$this->db->select("penugasan.id_penugasan, DATE_FORMAT(jadwal.tanggal, '%d %b %Y') AS tanggal, pelanggan.nama, jenis_pelanggan.jenis_pelanggan, paket.nama_paket,penugasan.tujuan, teknisi.nama_panggilan, jadwal.id_jadwal");
		return $this->db->get()-> result_array();
	}
	public function getCountAllJadwal()
	{	
		$this->db->order_by('jadwal.tanggal','desc');
		$this->db->group_by('jadwal.id_jadwal');
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('jadwal');
		$this->db->select("penugasan.id_penugasan, DATE_FORMAT(jadwal.tanggal, '%d %b %Y') AS tanggal, pelanggan.nama, jenis_pelanggan.jenis_pelanggan, paket.nama_paket,penugasan.tujuan, teknisi.nama_panggilan, jadwal.id_jadwal");
		return $this->db->get()-> num_rows();
	}
	public function getNewIdJadwal()
	{
		$q=$this->db->query("SELECT MAX(id_jadwal) AS id_max FROM jadwal");	
		$kd="J";
		if  ($q->num_rows()>0 OR $q != 'NULL'){
			foreach ($q->result() as $k) {
				$angka = substr($k->id_max, 7);
				$tmp=(int) $angka+1;
				$kd=sprintf("%04s",$tmp);
			}
		}
	
		else {
			$kd="0001";
		}
		date_default_timezone_get();
		return "j-".date ('dmy')."".$kd;
	}
	
	public function getNewIdPenugasan()
	{
		$q=$this->db->query("SELECT MAX(id_penugasan) AS id_max FROM penugasan");	
		$kd="J";
		if  ($q->num_rows()>0 OR $q != 'NULL'){
			foreach ($q->result() as $k) {
				$angka = substr($k->id_max, 7);
				$tmp=(int) $angka+1;
				$kd=sprintf("%04s",$tmp);
			}
	}
		else {
			$kd="0001";
		}
	//date_default_timezone_get();
	return "T-".date ('my')."".$kd;
	}
	
	public function getAllPelanggan()
	{
		$this->db->order_by('pelanggan.id_pelanggan', 'asc');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = langganan.id_pelanggan');
		$this->db->from('langganan');
		$this->db->select("*");
		return $this->db->get()-> result_array();

	}
	public function getAllTeknisi()
	{
		$this->db->order_by('nama_teknisi', 'asc');
		$result = $this->db->get('teknisi')->result_array();

		return $result;
	}
	public function getAllPaket($id_pelanggan)
	{
		$this->db->where('pelanggan.id_pelanggan',$id_pelanggan);
		$this->db->join('paket', 'paket.id_paket = langganan.id_paket');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan= langganan.id_pelanggan');
		$result = $this->db->get('langganan')->result();

		return $result;
	}
	
	public function getAllJenisPelanggan()
	{
		$this->db->order_by('jenis_pelanggan', 'asc');
		$result = $this->db->get('jenis_pelanggan')->result_array();

		return $result;
	}	
	public function tambahDataJadwal()
	{
		$idJadwal = $this->input->post('id_jadwal', true);
		$idTugas = $this->input->post('id_penugasan', true);
		$jmlTeknisi = $this->input->post('jmlTeknisi', true);
		
		$data1 = 
			[
				"id_jadwal" => $idJadwal,
				"tanggal" => $this->input->post('tanggal', true),
				"id_langganan" => $this->input->post('id_langganan', true)
			];
		$this->db->insert('jadwal',$data1);  
		
		for($a=1;$a<=$jmlTeknisi;$a++){ 
			$data2 = 
			[
				"id_penugasan" => $idTugas,
				"id_jadwal" => $idJadwal,
				"id_teknisi" => $this->input->post('nama_panggilan'.$a, true),
				"tujuan" => $this->input->post('tujuan', true)
			];
			$this->db->insert('penugasan',$data2);
		}
	}
	
	public function getJadwalById($id_jadwal)
	{
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		
		return  $this->db->get_where('jadwal', ['jadwal.id_jadwal' => $id_jadwal])->row_array();
		
	}
	
	public function getTeknisiByJadwalId($id_jadwal)
	{
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		
		return  $this->db->get_where('jadwal', ['jadwal.id_jadwal' => $id_jadwal])->result_array();
		
	}
	
	public function getPenugasanByIdJadwal($id_penugasan)
	{
		//$this->db->group_by('penugasan.id_penugasan');
		$this->db->where('jadwal.id_jadwal',$id_penugasan);
		$this->db->join('jadwal', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('penugasan');
		$this->db->select("teknisi.nama_panggilan");
		return  $this->db->get()->result_array();
	}

	public function hapusDataJadwal($id_jadwal)
	{
		//$this->db->where('id_jadwal',$id_jadwal); 
		$this->db->delete('jadwal',['id_jadwal' => $id_jadwal]); 
	}

	public function ubahDataJadwal()
	{
		$jmlTeknisi = $this->input->post('jmlTeknisi', true);
		$data1 = 
			[
				"id_jadwal" => $this->input->post('id_jadwal', true),
				"tanggal" => $this->input->post('tanggal', true),
				"id_langganan" => $this->input->post('id_langganan', true)
			];
			
	   	$this->db->where('id_jadwal',$this->input->post('id_jadwal'));
		$this->db->update('jadwal',$data1);
		
		for($a=1;$a<=$jmlTeknisi;$a++){ 
		   
			$data2 = 
			[
				"id_penugasan" => $this->input->post('id_penugasan', true),
				"id_jadwal" => $this->input->post('id_jadwal', true),
				"id_teknisi" => $this->input->post('teknisi'.$a, true),
				"tujuan" => $this->input->post('tujuan', true)
			];
			
			$this->db->where('id_teknisi',$this->input->post('teknisi_before'.$a));  
			$this->db->where('id_penugasan',$this->input->post('id_penugasan'));  
			$this->db->update('penugasan',$data2);
		}		
	}
	
	public function cariDataJadwal()
	{
		$keyword = $this->input->post('keyword', true);
		
		$this->db->group_by('penugasan.id_penugasan');
		$this->db->group_start();
		$this->db->like('pelanggan.nama', $keyword);
		$this->db->or_like('teknisi.nama_panggilan', $keyword);
		$this->db->or_like('pelanggan.alamat', $keyword);
		$this->db->or_like('pelanggan.No_HP', $keyword);
		$this->db->group_end();
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		
		$this->db->from('jadwal');
		$this->db->select("DATE_FORMAT(jadwal.tanggal, '%d %b %Y') AS tanggal, pelanggan.nama, jenis_pelanggan.jenis_pelanggan, paket.nama_paket,penugasan.tujuan, teknisi.nama_panggilan AS nama_panggilan, jadwal.id_jadwal");
		return $this->db->get()-> result_array();
	}
	public function getAllCetak()
	{	
		$this->db->join('langganan', 'langganan.id_langganan = jadwal.id_langganan');
		$this->db->join('pelanggan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('penugasan', 'penugasan.id_jadwal = jadwal.id_jadwal');
		$this->db->join('teknisi', 'penugasan.id_teknisi = teknisi.id_teknisi');
		$this->db->from('jadwal');
		$this->db->select("DATE_FORMAT(jadwal.tanggal, '%d %b %Y') AS tanggal, pelanggan.nama, penugasan.tujuan, nama_panggilan");
		return $this->db->get()-> result_array();
	}
}
<?php

class Pelanggan_model extends CI_model {
	
	//model untuk pagination
	//juamlah data pelanggan
	public function jmlAllPelanggan()
	{
		$kategori = $this->uri->segment('3');
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->where('kategori_layanan.kategori_layanan',$kategori);
		return $this->db->get("pelanggan")->num_rows();
	}
	
	//data pelanggan
	public function getPelangganAll()
	{
		$halamanKe = $this->uri->segment('4') != NULL ? $this->uri->segment('4') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);			
		$kategori = $this->uri->segment('3');
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->where('kategori_layanan.kategori_layanan',$kategori);		
		return $this->db->get('pelanggan')-> result_array();
	}
	//data semua pelanggan
	public function getDataPelangganAll()
	{
		$halamanKe = $this->uri->segment('4') != NULL ? $this->uri->segment('4') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);		
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
			
		return $this->db->get('pelanggan')-> result_array();
	}
	
	public function getCountAllPelanggan()
	{
		$kategori = $this->uri->segment('3');
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->where('kategori_layanan.kategori_layanan',$kategori);		
		return $this->db->get('pelanggan')-> num_rows();
	}
	
	public function getCountAllDataPelanggan()
	{		
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
			
		return $this->db->get('pelanggan')-> num_rows();
	}
	public function getAllPaket()
	{
		$this->db->order_by('nama_paket', 'asc');
		$result = $this->db->get('paket')->result_array();

		return $result;
	}
	
	public function getAllJenisPelanggan()
	{
		$this->db->order_by('jenis_pelanggan', 'asc');
		$result = $this->db->get('jenis_pelanggan')->result_array();

		return $result;
	}

	public function tambahDataPelanggan()
	{
		$idPelanggan= $this->input->post('id_pelanggan', true);
		$idLangganan = $this->input->post('id_langganan', true);
		$data1 = [
				"id_pelanggan" => $idPelanggan,
				"nama" => $this->input->post('nama', true),
				"alamat" => $this->input->post('alamat', true),
				"No_Telp" => $this->input->post('No_Telp', true),
				"No_HP" => $this->input->post('No_HP', true),
				"status" => $this->input->post('status', true)
		];
		$data2 = [
				"id_langganan" => $idLangganan,
				"id_pelanggan" => $this->input->post('id_pelanggan', true),
				"id_paket" => $this->input->post('paket', true),
				"id_jenis_pelanggan" => $this->input->post('jenis_pelanggan', true)
		];
		$this->db->insert('pelanggan',$data1);   
		$this->db->insert('langganan',$data2);   
	}
	public function hapusDataPelanggan($id_pelanggan)
	{
		//$this->db->where('id_pelanggan',$id_pelanggan); 
		$this->db->delete('pelanggan',['id_pelanggan' => $id_pelanggan]); 
	}
	public function getPelangganById($id_pelanggan)
	{
		
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		$this->db->where('pelanggan.id_pelanggan',$id_pelanggan);	
		return  $this->db->get('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array();
	}
	
	public function ubahDataPelanggan()
	{
		$data1 = [
				"id_pelanggan" => $this->input->post('id_pelanggan', true),
				"nama" => $this->input->post('nama', true),
				"alamat" => $this->input->post('alamat', true),
				"No_Telp" => $this->input->post('No_Telp', true),
				"No_HP" => $this->input->post('No_HP', true),
				"status" => $this->input->post('status', true)
		];
		$data2 = [
				"id_pelanggan" => $this->input->post('id_pelanggan', true),
				"id_paket" => $this->input->post('paket', true),
				"id_jenis_pelanggan" => $this->input->post('jenis_pelanggan', true)
		];
		$this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
		$this->db->update('pelanggan',$data1);
		
		$this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
		$this->db->update('langganan',$data2);   		
	}
	public function cariDataPelanggan()
	{
		$kategori = $this->uri->segment('3');
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		
		$keyword = $this->input->post('keyword', true);
		$this->db->where('kategori_layanan.kategori_layanan',$kategori,'both');
		$this->db->group_start();
		$this->db->like('pelanggan.nama', $keyword, 'both');
		$this->db->or_like('pelanggan.id_pelanggan', $keyword, 'both');
		$this->db->or_like('pelanggan.alamat', $keyword, 'both');
		$this->db->or_like('pelanggan.No_Telp', $keyword, 'both');
		$this->db->or_like('pelanggan.No_HP', $keyword, 'both');
		$this->db->or_like('jenis_pelanggan.jenis_pelanggan', $keyword, 'both');
		$this->db->or_like('paket.nama_paket', $keyword, 'both');
		$this->db->or_like('pelanggan.status', $keyword, 'both');
		$this->db->group_end();
		
		return $this->db->get('pelanggan')->result_array();
	}
public function cariDataDataPelanggan()
	{
		
		$this->db->join('langganan', 'langganan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('paket', 'langganan.id_paket = paket.id_paket');
		$this->db->join('jenis_pelanggan', 'langganan.id_jenis_pelanggan = jenis_pelanggan.id_jenis_pelanggan');
		$this->db->join('kategori_layanan', 'kategori_layanan.id_kategori_layanan = paket.id_kategori_layanan');
		
		$keyword = $this->input->post('keyword', true);
		
		$this->db->group_start();
		$this->db->like('pelanggan.nama', $keyword, 'both');
		$this->db->or_like('pelanggan.id_pelanggan', $keyword, 'both');
		$this->db->or_like('pelanggan.alamat', $keyword, 'both');
		$this->db->or_like('pelanggan.No_Telp', $keyword, 'both');
		$this->db->or_like('pelanggan.No_HP', $keyword, 'both');
		$this->db->or_like('jenis_pelanggan.jenis_pelanggan', $keyword, 'both');
		$this->db->or_like('paket.nama_paket', $keyword, 'both');
		$this->db->or_like('pelanggan.status', $keyword, 'both');
		$this->db->group_end();
		
		return $this->db->get('pelanggan')->result_array();
	}
	public function getNewIdPelanggan()
	{
		$q=$this->db->query("SELECT MAX(id_pelanggan) AS id_max FROM pelanggan");	
		$kd="PT";
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
		return "P-".date ('dmy')."".$kd;
	}
	
	public function getNewIdLangganan()
	{
		$q=$this->db->query("SELECT MAX(id_langganan) AS id_max FROM langganan");	
		$kd="PT";
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
	return "L-".date ('my')."".$kd;
	}
}
<?php

class Cs_model extends CI_model {
	public function getAllCs()
	{
		return $this->db->get('costumer_servis')-> result_array();
	}
	public function tambahDataCs()
	{
		$data = 
			[
				"id_cs" => $this->input->post('id_cs', true),
				"nama" => $this->input->post('nama', true),
				"alamat" => $this->input->post('alamat', true),
				"No_HP" => $this->input->post('No_HP', true)
			];
		$this->db->insert('costumer_servis',$data);   
	}
	public function getCsById($id_cs)
	{
		return  $this->db->get_where('costumer_servis', ['id_cs' => $id_cs])->row_array();
	}

	public function hapusDataCs($id_cs)
	{
		//$this->db->where('id_cs',$id_cs); 
		$this->db->delete('costumer_servis',['id_cs' => $id_cs]); 
	}

	public function ubahDataCs()
	{
		$data = 
			[
				"id_cs" => $this->input->post('id_cs', true),
				"nama" => $this->input->post('nama', true),
				"alamat" => $this->input->post('alamat', true),
				"No_HP" => $this->input->post('No_HP', true)
			];
		$this->db->where('id_cs',$this->input->post('id_cs'));
		$this->db->update('costumer_servis',$data);   
	}
}
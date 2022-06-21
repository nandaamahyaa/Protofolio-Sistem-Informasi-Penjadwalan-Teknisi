<?php
class Login_model extends CI_Model
{
    //cek username dan password sp
    function auth_sp($username,$password)
	{
        $query=$this->db->query("SELECT * FROM supervisor WHERE nama_panggilan='$username' AND password='$password' ");
        return $query;
    }
 
    //cek username dan password cs
    function auth_cs($username,$password)
	{
        $query=$this->db->query("SELECT * FROM costumer_servis WHERE nama_panggilan='$username' AND password='$password' ");
        return $query;
    }
	//cek username dan password t
    function auth_t($username,$password)
	{
        $query=$this->db->query("SELECT * FROM teknisi WHERE nama_panggilan='$username' AND password='$password' ");
        return $query;
    }
 
}
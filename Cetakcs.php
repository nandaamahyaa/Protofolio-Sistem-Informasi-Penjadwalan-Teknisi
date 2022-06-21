<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetakcs extends CI_Controller {
	Public function index()
	{
		$this->load->view('templates/headercs');
		$this->load->view('cetak/cs');
		$this->load->view('templates/footercs');
	}
}
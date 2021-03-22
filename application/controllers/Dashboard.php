<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$header_data = [
			'menu' => 'dashboard',
			'title' => 'Dashboard'
		];

		$this->load->view('includes/header', $header_data);
		$this->load->view('dashboard/dashboard');
		$this->load->view('includes/footer');
	}
}

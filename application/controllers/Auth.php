<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data = [
			'login_action_url'	=> base_url('auth/login_action'),
			'forgot_password_url'	=> base_url('auth/forgot'),
			'signup_url'			=> base_url('auth/signup')
		];

		$this->load->view('includes/blank_header');
		$this->load->view('auth/auth', $data);
		$this->load->view('includes/blank_footer');
	}

	public function login_action() {

	}

	public function signup() {

	}
	
	public function forgot() {

	}
}

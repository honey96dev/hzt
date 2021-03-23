<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
    }

    public function index()
    {
        $data = [
            'login_action_url' => base_url('auth/login_action'),
            'forgot_password_url' => base_url('auth/forgot'),
            'signup_url' => base_url('auth/signup'),
        ];

        $this->load->view('includes/blank_header');
        $this->load->view('auth/auth', $data);
        $this->load->view('includes/blank_footer');
    }

    public function login_action()
    {
        if ($this->input->post()) {
            $login_data = $this->input->post();
            $result = $this->auth->verify_user($login_data);
            echo json_encode($result);
            return;
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }

    public function signup()
    {

    }

    public function forgot()
    {

    }

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
}

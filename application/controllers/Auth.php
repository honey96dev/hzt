<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('customers_model', 'customers');
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
            $result['return_url'] = is_admin() ? base_url() : base_url('dashboard/customer');
            echo json_encode($result);
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }

    public function signup()
    {
        $data = [
            'signin_url' => base_url('auth'),
            'signup_action_url' => base_url('auth/signup_action'),
        ];

        $this->load->view('includes/blank_header');
        $this->load->view('auth/signup', $data);
        $this->load->view('includes/blank_footer');
    }

    public function signup_action()
    {
        if ($this->input->post()) {
            $signup_data = $this->input->post();
            $result = $this->auth->signup($signup_data);
            echo json_encode($result);
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }

    public function forgot()
    {
        $data = [
            'signin_url' => base_url('auth'),
            'signup_url' => base_url('auth/signup'),
            'forgot_action_url' => base_url('auth/forgot_action'),
        ];

        $this->load->view('includes/blank_header');
        $this->load->view('auth/forgot', $data);
        $this->load->view('includes/blank_footer');
    }

    public function forgot_action()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $email = $data['email'];
            $customer = $this->customers->get_customer_by_email($email);
            if (!isset($customer['id']) || $customer['id'] == '') {
                echo json_encode(['result' => 'not-exist']);
                return;
            }
            if ($customer['is_verified'] != '') {
                $this->auth->send_verify_email($customer['id']);
            } else {
                $this->auth->update_verify_code($customer['id']);
                $this->auth->send_verify_email($customer['id']);
            }
            echo json_encode(['result' => 'success']);
            return;
        } else {
            echo json_encode(['result' => 'failed']);
            return;
        }
    }

    public function verify_password($hash = '') {
        if ($hash == '') {
            redirect('auth');
        }

        $data = [
            'login_url' => base_url('auth'),
            'info' => $this->auth->update_password($hash) ? 'success' : 'failed'
        ];

        $this->load->view('includes/blank_header');
        $this->load->view('auth/notify', $data);
        $this->load->view('includes/blank_footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }

    public function change()
    {
        $id = current_customer_id();

        $header_data = [
            'title' => 'Cambiar ajustes',
            'change_action_url' => base_url('auth/change_action/' . $id),
        ];

        $data = [
            'user' => $this->customers->get_customer_by_id($id),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('auth/change_setting', $data);
        $this->load->view('includes/footer');
    }

    public function change_action($id = 0) {
        if ($this->input->post()) {
            $settings = $this->input->post();
            $config['upload_path'] = PROFILE_IMAGE_PATH;
            $config['allowed_types']        = 'jpg|jpeg|png|bmp';
            $config['max_size'] = 10240;
            $config['file_name'] = md5(time());

            $this->load->library('upload', $config);
            $origin_user = $this->customers->get_customer_by_id($id);
            if ( $this->upload->do_upload('avatar')) {
                $origin_file_path = PROFILE_IMAGE_PATH . $origin_user['avatar'];
                if (@file_exists($origin_user)) {
                    @unlink($origin_user);
                }
                $upload_info = $this->upload->data();

                $settings['avatar'] = $upload_info['file_name'];
            } else {
                $settings['avatar'] = $origin_user['avatar'];
            }
            $result = $this->auth->change($id, $settings);
            echo json_encode($result);
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }
}

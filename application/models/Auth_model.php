<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->load->model('customers_model', 'customers');
    }

    /**
     * @return  {Array} ['result' => error | success, 'msg' => status message]
     * @param   {Array} Login user information
     */
    public function verify_user($login_data = [])
    {
        if (empty($login_data)) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if ($this->customers->get_customer_by_email($login_data['identity']) === false &&
            $this->customers->get_customer_by_username($login_data['identity']) === false) {
            return [
                'result' => 'error',
                'msg' => 'Your username or email is not existed. Please signup and try again.',
            ];
        }

        $user_info = ($this->customers->get_customer_by_email($login_data['identity']) === false) ?
        $this->customers->get_customer_by_username($login_data['identity']) :
        $this->customers->get_customer_by_email($login_data['identity']);

        // Verify password
        if (!verify_password($login_data['password'], $user_info['password'])) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if (!$user_info['status']) {
            return [
                'result' => 'error',
                'msg' => 'Administrator is reviewing your information. Please try again later.',
            ];
        }

        $this->session->set_userdata('user', $user_info);
        return [
            'result' => 'success',
        ];
    }
    /**
     * @return  Array   Signup Result ['result' => success | error, 'msg' => 'Successful']
     * @param   Array   Signup customer data
     */
    public function signup($signup_data = [])
    {
        if (empty($signup_data)) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if ($this->customers->get_customer_by_email($signup_data['user_name']) !== false ||
            $this->customers->get_customer_by_username($signup_data['email']) !== false) {
            return [
                'result' => 'error',
                'msg' => 'Your username or email is existed already. Please try again.',
            ];
        }

        $new_customer_data = [
            'user_name' => $signup_data['user_name'],
            'first_name'    => $signup_data['first_name'],
            'surname'       => $signup_data['surname'],
            'email'         => $signup_data['email'],
            'password'      => generate_password($signup_data['password']),
            'role'          => 0,
            'status'        => 0,
            'goal'          => 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($this->db->insert($this->table, $new_customer_data)) {
            return [
                'result' => 'success'
            ];
        } else {
            return [
                'result' => 'error',
                'msg' => 'You cannot signup currently. Please check and try again.',
            ];
        }
    }

    public function change($user_id = 0, $settings = []) {
        if ($user_id == 0) {
            return ['result' => 'error'];
        }

        $origin_user = $this->customers->get_customer_by_id($user_id);

        if ($settings['current_password'] != '' && !verify_password($settings['current_password'], $origin_user['password'])) {
            return ['result' => 'failed'];
        }

        $new_settings = [
            'user_name' => $settings['username'],
            'first_name' => $settings['first_name'],
            'surname' => $settings['last_name'],
            'avatar'  => $settings['avatar'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($settings['current_password'] != '' && $settings['password'] != '') {
            $new_settings['password'] = generate_password($settings['password']);
        }

        if ($this->db->update($this->table, $new_settings, ['id' => $user_id])) {
            return ['result' => 'success'];
        } else {
            return ['result' => 'error'];
        }
    }

    public function update_verify_code($customer_id = 0) {
        if ($customer_id == 0) {
            return false;
        }

        return $this->db->update($this->table, ['is_verified' => md5(time())], ['id' => $customer_id]);
    }

    public function send_verify_email($customer_id = 0) {
        if ($customer_id == 0) {
            return false;
        }
        
        $customer = $this->customers->get_customer_by_id($customer_id);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SMTP_USER,
            'smtp_pass' => SMTP_PASSWORD,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->from(COMPANY_EMAIL, COMPANY_NAME);
        $this->email->to($customer['email']);

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        $this->email->set_newline("\r\n");
                        
        $result = $this->email->send();
    }

    public function update_password($hash = '') {
        $customers = $this->customers->get_customer_list('is_verified = "' . $hash . '"');
        if (count($customers) > 0) {
            return $this->db->update($this->table, ['password' => generate_password($customers[0]['email'])], ['id' => $customers[0]['id']]);
        } else {
            return false;
        }
    }
}
